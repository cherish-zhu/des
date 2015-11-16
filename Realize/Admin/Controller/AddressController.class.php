<?php
namespace Admin\Controller;
use Think\Controller;
class addressController extends Controller{
	
	public function province(){
		echo json_encode(M('province')->field("provinceName,provinceId")->select());
	}
	
	public function city($id){
		echo json_encode(M('city')->field("cityName,cityId")->where(array('cityUpId'=>$id))->select());
	}
	
	public function county($id){
		echo json_encode(M('district')->field("districtName,districtId")->where(array('districtUpId'=>$id))->select());
	}
	
	public function _province(){
		return M('province')->field("provinceName,provinceId")->select();
	}
	
	public function _city($id){
		return M('city')->field("cityName,cityId")->where(array('cityUpId'=>$id))->select();
	}
	
	public function _county($id){
		return M('district')->field("districtName,districtId")->where(array('districtUpId'=>$id))->select();
	}
	
}