<?php

namespace Admin\Util;

class Admin {

    //存储用户uid的Key
    const userUidKey = 'userid';
    //超级管理员角色id
    const administratorRoleId = 1;

    //当前登录会员详细信息
    private static $userInfo = array();

    /**
     * 连接后台用户服务
     * @staticvar \Admin\Util\Admin $systemHandier
     * @return \Admin\Util\Admin
     */
    static public function getInstance() {
        static $handier = NULL;
        if (empty($handier)) {
            $handier = new Admin();
        }
        return $handier;
    }

    /**
     * 魔术方法
     * @param type $name
     * @return null
     */
    public function __get($name) {
        //从缓存中获取
        if (isset(self::$userInfo[$name])) {
            return self::$userInfo[$name];
        } else {
            $userInfo = $this->getInfo();
            if (!empty($userInfo)) {
                return $userInfo[$name];
            }
            return NULL;
        }
    }

    /**
     * 获取当前登录用户资料
     * @return array 
     */
    public function getInfo() {
        if (empty(self::$userInfo)) {
            self::$userInfo = $this->getUserInfo($this->isLogin());
        }
        return !empty(self::$userInfo) ? self::$userInfo : false;
    }

    /**
     * 检验用户是否已经登陆
     * @return boolean 失败返回false，成功返回当前登陆用户基本信息
     */
    public function isLogin() {
        $userId = json_decode(session(self::userUidKey));
        if (empty($userId)) {
            return false;
        }
        return (int) $userId;
    }

    //登录后台
    public function login($identifier, $password) {
        if (empty($identifier) || empty($password)) {
            return false;
        }
        //验证
        $userInfo = $this->getUserInfo($identifier, $password);
        if (false == $userInfo) {
            //记录登录日志
            $this->record(0, $identifier.'登录后台密码错误:'.$password, 0);
            return false;
        }
        //记录登录日志
        $this->record($userInfo['id'], $userInfo['username'].'登录后台', 1);
        //注册登录状态
        $this->registerLogin($userInfo);
        return true;
    }

    /**
     * 检查当前用户是否超级管理员
     * @return boolean
     */
    public function isAdministrator() {
        $userInfo = $this->getInfo();
        if (!empty($userInfo) && $userInfo['role_id'] == self::administratorRoleId) {
            return true;
        }
        return false;
    }

    /**
     * 注销登录状态
     * @return boolean
     */
    public function logout() {
        session('[destroy]');
        return true;
    }

    /**
     * 记录登陆日志
     * @param type $identifier 登陆方式，uid,username
     * @param type $password 密码
     * @param type $status
     */
    private function record($adminid, $info, $status = 0) {
        //登录日志
        $data = array(
            "adminid" => $adminid,
            "status" => $status,
        	"ip" => get_client_ip(),
        	"time" => time(),
            "info" => $info,
        );
        if(M('Logs')->create($data)){
        	return M('Logs')->add() !== false ? true : false;
        }
        return false;
    }

    /**
     * 注册用户登录状态
     * @param array $userInfo 用户信息
     */
    private function registerLogin(array $userInfo) {
        //写入session
        session(self::userUidKey, encode((int) $userInfo['id']));
        //更新状态
        D('Admin')->loginStatus((int) $userInfo['id']);
        //注册权限
        \Admin\Util\Rbac::saveAccessList((int) $userInfo['id']);
    }

    /**
     * 获取用户信息
     * @param type $identifier 用户名或者用户ID
     * @return boolean|array
     */
    private function getUserInfo($identifier, $password = NULL) {
        if (empty($identifier)) {
            return false;
        }
        return D('Admin')->getUserInfo($identifier, $password);
    }

}
