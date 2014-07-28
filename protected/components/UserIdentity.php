<?php

class UserIdentity extends CUserIdentity
{
    private $_id;
    
    public function authenticate()
    {
        $username=strtolower($this->username);
        $user_admin=Admin::model()->find('LOWER(user)=?',array($username));
        $user_player=TournamentPlayer::model()->find('LOWER(mail)=?',array($username));

        if(($user_admin===null)&&($user_player===null)){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }else{
            if(($user_player === null)&&(!($user_admin === null))){
                if(!$user_admin->validatePassword($this->password)){
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
                    return $this->errorCode==self::ERROR_PASSWORD_INVALID;
                }else{ //Everything went fine and the user is an admin.
                    $this->_id=$user_admin->id;
                    $this->username=$user_admin->user;
                    $this->errorCode=self::ERROR_NONE;
                    return $this->errorCode==self::ERROR_NONE;
                }
            }//end if for admin
            else if(($user_admin === null)&&(!($user_player === null))){
                if(!($user_player->validatePassword($this->password))) {
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
                }else{ //Everything went fine, and the user is a player.
                    $this->_id=$user_player->id;
                    $this->username=$user_player->mail;
                    $this->errorCode=self::ERROR_NONE;
                    return $this->errorCode==self::ERROR_NONE;
                }
            }else{ //The user isn't an admin or a player....
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
        }
    }
 
    public function getId()
    {
        return $this->_id;
    }
}