<?php //error_reporting(3);
	class Paging {
		var $sql;
		var $rs;
		var $numrows;
		var $limit;
		var $noofpage;
		var $offset;
		var $page;
		var $style;
		var $parameter;
		var $activestyle;
		var $buttonstyle;
		function Paging($query) {
			$this->offset=0;
			$this->page=1;
			$this->sql=$query;
			$this->rs=mysql_query($this->sql);
			$this->numrows=@mysql_num_rows($this->rs);			
		}
		function getNumRows() {
			return $this->numrows;
		}
		function setLimit($no) {
			$this->limit=$no;
		}
		function getLimit() {
			return $this->limit;
		}
		function getNoOfPages() {
			return ceil($this->noofpage=($this->getNumRows()/$this->getLimit()));
		}
		function getPageNo() {
			$str="";
			$str=$str."<table width='100%' border='0' bgcolor='#EEFAFF' align='center'><tr>";
			
			$str=$str."<td align='center' valign='top'>";
			$str=$str."<font size=\"3\"><b>Page(s): </b></font>";
						    $querystr=$_SERVER['QUERY_STRING'];
				$qtemp=explode("&",$querystr);
				$fqstr='';
				//print_r($qtemp);exit;
				for($hj=0;$hj<count($qtemp);$hj++)
				{		
				//echo strstr($qtemp[$hj],'page=');
				   if(strstr($qtemp[$hj],'page=')=='' && $qtemp[$hj]!='')
				   {
				     $fqstr.='&'.$qtemp[$hj];
				   }

				}

			if($this->getPage()>1) {
 
				$str=$str."<a href='".str_replace(strstr($_SERVER['REQUEST_URI'],"?"),"",$_SERVER['REQUEST_URI'])."?".page."=".($this->getPage()-1).$this->getParameter().$fqstr."' class='".$this->getStyle()."'><font size=3>Back</font></a>&nbsp;";
			}
			for($i=1;$i<=$this->getNoOfPages();$i++) {
				if($i==$this->getPage()) {
					$str=$str."<span class='".$this->getActiveStyle()."'>".$i."&nbsp;</span>";
				}
				else {
					$str=$str."<a href='".str_replace(strstr($_SERVER['REQUEST_URI'],"?"),"",$_SERVER['REQUEST_URI'])."?page=".$i.$this->getParameter().$fqstr."' class='".$this->getStyle()."'><font size=3>".$i."</font></a>&nbsp;";
					if(($i%20)==0)
					{
					$str=$str. "<br>"; 
					}
				}
			}
			if($this->getPage()<$this->getNoOfPages()) {
				$str=$str."<a href='".str_replace(strstr($_SERVER['REQUEST_URI'],"?"),"",$_SERVER['REQUEST_URI'])."?page=".($this->getPage()+1).$this->getParameter().$fqstr."' class='".$this->getStyle()."'><font size=3>Next</font></a>";
			}
			$str=$str."</td>";
			$str=$str."</tr></table>";
			print $str;
		}
		function getOffset($page) {
			if($page>$this->getNoOfPages()) {
				$page=$this->getNoOfPages();
			}
			if($page=="") {
				$this->page=1;
				$page=1;
			}
			else {
				$this->page=$page;
			}
			if($page=="1") {
				$this->offset=0;
				return $this->offset;
			}
			else {
				for($i=2;$i<=$page;$i++) {
					$this->offset=$this->offset+$this->getLimit();
				}
				return $this->offset;
			}
		}
		function getPage() {
			return $this->page;
		}
		function setStyle($style) {
			$this->style=$style;
		}
		function getStyle() {
			return $this->style;
		}
		function setActiveStyle($style) {
			$this->activestyle=$style;
		}
		function getActiveStyle() {
			return $this->activestyle;
		}
		function setButtonStyle($style) {
			$this->buttonstyle=$style;
		}
		function getButtonStyle() {
			return $this->buttonstyle;
		}
		function setParameter($parameter) {
			$this->parameter=$parameter;
		}
		function getParameter() {
			return $this->parameter;
		}
	}
?>
