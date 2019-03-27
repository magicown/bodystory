<?php
include_once(G5_LIB_PATH."/bart/imageutil.php");
include_once(G5_LIB_PATH."/bart/thumbnail.php");
include_once(G5_LIB_PATH."/bart/filedir.php");
include_once(G5_LIB_PATH."/bart/crawler.php");

class BFileCrawler extends BCrawler{
	private $down_url;
	private $down_path;
	
	private $doc;
	
	private $watermark_path;
	private $exist_watermark = false;
	
	private $down_imgs = array();
	
	public function __construct(){
		
		parent::__construct();
		
		//$this->http->setCookieFile(G5_DATA_PATH."/cookie.txt");
		
		$this->watermark_path = G5_DATA_PATH.'/bart/'.$this->btcfg["cf_watermark"];
		$this->exist_watermark = file_exists($this->watermark_path);
	}
	
	public function __destruct(){
		
		$this->down_url = null;
		$this->down_path = null;
		$this->btcfg = null;
		$this->watermark_path = null;
		$this->exist_watermark = null;
		$this->down_imgs = null;
		
		unset(
			$this->down_url,
			$this->down_path,
			$this->btcfg,
			$this->watermark_path,
			$this->exist_watermark,
			$this->down_imgs
		);
		
		parent::__destruct();
	}
	
	public function setDownloadDirPath($path){
		$this->down_path = $path;
	}
	
	public function setDownloadDirUrl($url){
		$this->down_url = $url;
	}
	
	public function downloadFile($fileurls, $refer=""){
		
		$downlist = array();
				
		for($i=0;$i<count($fileurls);$i++){
			
			@include(G5_LIB_PATH."/bart/user/before_filedownload.php");
			
			if(trim($fileurls[$i])=="") continue;
			$fileurl = $fileurls[$i];
			
			//BFiledir::autoMkdir($dir_path, 0707);
			if(!is_dir($this->down_path))
				mkdir($this->down_path, 0755, true);

			$info = $this->http->setUrl($fileurl);
			
			if($refer != ""){
				$this->http->setRefer($refer);
			}else{
				$temp = @parse_url($fileurl);
				if(!isset($temp["host"]) || !bt_isval($temp["host"])) continue;
				$this->http->setRefer($temp["scheme"]."://".$temp["host"]);
			}
			
			try{
				
				if($info = $this->http->downloadFile($this->down_path)){
										
					$downlist[] = $info; //array(rname, vname);
					
					//torrent 파일이면
					$ext = strtolower(BFiledir::getExtName($info["vname"]));
					$exp = trim($this->btcfg["cf_torrent_exp"]);
					$author = trim($this->btcfg["cf_torrent_author"]);
					
					if($ext == "torrent" && $exp != ""){
						
						$data = file_get_contents($this->down_path."/".$info["rname"]);
						
						$torrent = new Torrent();
						if(!$torrent->load($data)){
							throw new Exception($torrent->error);
						}
						$torrent->setComment($exp);
						$torrent->setCreatedBy($author);
						$data = $torrent->bencode();
						file_put_contents($this->down_path."/".$info["rname"], $data);
						
						unset($data);
						unset($torrent);
					}
				}

				@include(G5_LIB_PATH."/bart/user/after_filedownload.php");

			}catch(Exception $e){
				throw new Exception("파일 다운로드 실패 - ".$fileurl." [".$e->getMessage()."]");
			}
		}
		
		return $downlist;
	}
	
	private function procDownloadImage($base_url, $content, $mat, $type){
				
		if(isset($mat[1]) && is_array($mat[1]) && count($mat[1]) > 0){
						
			$imgs = $mat[1];
			$imgexc_domain = explode("\n", $this->btcfg["cf_imgexc_domain"]);
			
			
			//다운로드 처리 성공 갯수 카운터
			$imgcnt = 0;
			
			//다운로드 받은것 컨테이너(중복다운로드 방지를 위해)
			$downed = array();
			
			for($i=0;$i<count($imgs);$i++){
				
				//이미지 url이 공백이면 건너뛰기
				if(trim($imgs[$i])=="" ) continue;
				
				
				//다운로드 제외된 도메인인지 찾음
				$is_except = false;
				foreach($imgexc_domain as $item){
					if(trim($item) == "") continue;
					if(strstr($imgs[$i], $item)){
						$is_except = true;
						break;
					}
				}
				
				//url 정리
				$fileurl = bt_get_fullurl($base_url, $imgs[$i]);
				$fileurl = htmlspecialchars_decode($fileurl);
								
				try{
				
					//다운로드 받지않고 원본주소 그대로
					if($this->site["st_nodnimg"]=="1"){
						//$content = str_replace($mat[0][$i], "<img src=\"".$fileurl."\">", $content);
						$content = str_replace($mat[1][$i], $fileurl, $content);
						$imgcnt++;
					
					//다운로드 받고 주소변조
					}else{
						
						//이미지가 다운로드 제외 도메인이면
						if($is_except){
							//$content = str_replace($mat[0][$i], "<img src=\"".$imgs[$i]."\">", $content);
							//$content = str_replace($mat[0][$i], "<img src=\"".$imgs[$i]."\">", $content);
						
							$save_url = $img[$i];
							
						//정상 다운로드 대상이면
						}else if(!$is_except){
							
							if(!is_dir($this->down_path)){
								mkdir($this->down_path, 0755, true);
							}
							
							//파일명 encoding
							$temp = parse_url($fileurl);
							list($fname, $fext) = BFileDir::parseFilename($temp["path"]);
							if($fname!="" && $fext != ""){
								$fileurl = $temp["scheme"]."://"
									.$temp["host"].substr($temp["path"], 0, strrpos($temp["path"], "/"))
									."/".rawurlencode($fname).".".$fext;
								if(isset($temp["query"])) $fileurl .= "?".$temp["query"];
							}
														
							$this->http->setUrl($fileurl);
							$temp = parse_url($fileurl);
							//$this->http->setRefer($temp["scheme"]."://".$temp["host"]);
							$this->http->setRefer($base_url);
							
							//이미 다운로드 받은 파일이면
							if(in_array($mat[0][$i], $downed)){
								$save_url = array_search($mat[0][$i], $downed);
								//$content = str_replace($mat[0][$i], "<img src=\"".$save_url."\">", $content);
								$content = str_replace($mat[1][$i], $save_url, $content);
							
							//다운로드
							}else if($info = $this->http->downloadFile($this->down_path)){
								
								$save_url = $this->down_url."/".$info["rname"];
								$save_path = $this->down_path."/".$info["rname"];
								
								if(file_exists($save_path) && !BImageutil::isAnimatedGif($save_path)){
									$this->makeThumbnail($save_path);
								}
								
								//imgur 에 저장하기
								if($this->site["st_nodnimg"]=="3"){
									
									$fp = fopen($save_path, "r");
									$data = fread($fp, filesize($save_path));
									fclose($fp);
									$vars = array("image" => base64_encode($data));
									unset($data);
									
									$save_url = BHttp::imgurUpload($this->btcfg["cf_imgur_url"], $this->btcfg["cf_imgur_id"], $save_path, $vars, 30);
									
									if(trim($save_url)=="")
										throw new Exception("imgur 업로드 실패");
									
									if(substr($mat[0][$i], 0, 4)=="<img"){
										$content = str_replace($mat[0][$i], "<img src=\"".$save_url."\">", $content);
									}else{
										$content = str_replace($mat[1][$i], $save_url, $content);
									}
									
									//다운받은 이미지 삭제
									unlink($save_path);
									
									
								//서버에 그대로 저장하기
								}else{
									
									//다운로드 받은 이미지
									$this->down_imgs[] = array(
										"path" => $save_path,
										"url" => $save_url,
										"filename" => $info["rname"]
									);
																		
									list($w, $h) = getimagesize($save_path);
									
									if(substr($mat[0][$i], 0, 4)=="<img"){
										$content = str_replace($mat[0][$i], "<img src=\"".$save_url."\">", $content);
									}else{
										$content = str_replace($mat[1][$i], $save_url, $content);
									}
									
									//$content = str_replace($mat[1][$i], $save_url, $content);
									//$content = str_replace($mat[0][$i], "<img src=\"".$save_url."\" style=\"width:100%;min-height:".$w."px\">", $content);
									
									
								}
								
								$downed[$save_url] = $mat[1][$i];
							}
							
							$imgcnt++;
						}
						
						if(isset($save_url) && $type=="video"){
							$content .= PHP_EOL.'<p><img src="'.$save_url.'"></p>';
						}
					}
					
				}catch(Exception $e){
					//실패시 해당 이미지 태그 삭제
					$content = str_replace($mat[0][$i], "", $content);
				}
			}
			
			//이미지가 있는데 이미지 처리갯수가 0 이면
			if($type=="img" && count($imgs) > 0 && $imgcnt <= 0){
				throw new Exception("이미지 다운로드 실패");
			}
		}
		
		return $content;
	}
	
	public function getDownImages(){
		return $this->down_imgs;
	}
	
	public function downloadImage($base_url, $content){
		
		$this->down_imgs = array();
		
		//본문이미지 다운로드 : 다운로드 후 본문의 경로 변경
		//$img_pattern = "~<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>~isx";
		//$pattern = "~<img[^>]*src[\s\"']*\=[\s\"']*([^\"\'>\s]+)[^>]+>~isx";
		//$pattern = "~<img.+?src[\s\"']*=[\s\"']*([^\"'>\s]+)[^>]*>~isx";
		//$pattern = "~<img.+?src\s*=((?:\s*["'][^"']+)|(?:\s*[^\s>]+))~isx";
		$pattern = "~<img.+?src\s*=\s*(?:[\"']([^\"'>]+)|([^\s>]+))[^>]*>~isx";
		$cnt = preg_match_all($pattern, $content, $mat);
		
		for($i=0; $i<count($mat[1]); $i++){
			if(trim($mat[2][$i])!="") $mat[1][$i] = $mat[2][$i];
		}
		unset($mat[2]);
		
		$content = $this->procDownloadImage($base_url, $content, $mat, "img");
		
		$pattern = "~<video[^>]+poster[\s\"']*=[\s\"']*([^\"'>\s]+)[^>]*>~isx";
		$cnt = preg_match_all($pattern, $content, $mat);
				
		$content = $this->procDownloadImage($base_url, $content, $mat, "video");
		
		return $content;
	}
	
	private function makeThumbnail($file_path){
		
		//크기조정
		list($w, $h, $type) = getimagesize($file_path);
		if(!isset($type) || !in_array($type, array(1,2,3))) return;
		
		$maxw = (int)$this->btcfg["cf_img_maxw"];
		$maxh = (int)$this->btcfg["cf_img_maxh"];
		if((int)$this->site["st_img_maxw"] > 0)	$maxw = (int)$this->site["st_img_maxw"];
		if((int)$this->site["st_img_maxh"] > 0)	$maxh = (int)$this->site["st_img_maxh"];
				
		$options = array();
				
		if($maxw >= 0 || $maxh >= 0){
			
			if($maxw <= 0) $maxw = $w;
			if($maxh <= 0) $maxh = $h;
		
			list($w, $h) = BImageutil::rateLimit($file_path, $maxw, $maxh);
		}
		
		
		//워터마크
		$options = array(
			"keep_filename" => true,
			"quaility" => 100
		);
		$watermark_path = $this->watermark_path;
		if($this->site["st_wm_use"]=="1" && file_exists($watermark_path)==true){
			//워터마크 정보 정리
			$wm_pos = $this->site["st_wm_pos"];
			
			$wm_padding = 4;
			
			if((int)$this->site["st_wm_padding"] > 0){
				$wm_padding = $this->site["st_wm_padding"];
			}
			
			$options["watermark_path"] = $watermark_path;
			$options["watermark_pos"] = $wm_pos;
			$options["watermark_padding"] = $wm_padding;
		}
		
		$thumb = new BThumbnail($file_path, $file_path, $w, $h, $options);
		$thumb->save();
		
		$thumb = null;
		unset($thumb);
		usleep(100000);
	}
	
	public function execute(){}
		
	public static function getInstance(){
		static $inst = null;
		if($inst == null) $inst = new BFileCrawler();
		return $inst;
	}
}
