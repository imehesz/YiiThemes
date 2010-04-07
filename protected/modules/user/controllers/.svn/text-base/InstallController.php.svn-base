<?php

class InstallController extends Controller
{
	public function actionInstall() 
	{
		if($this->module->debug) 
		{
			if(Yii::app()->request->isPostRequest) 
			{
				if($db = Yii::app()->db) {
					$transaction = $db->beginTransaction();

					$usersTable = $_POST['usersTable'];
					$messagesTable = $_POST['messagesTable'];
					$profileFieldsTable = $_POST['profileFieldsTable'];
					$profileTable = $_POST['profileTable'];
					$rolesTable = $_POST['rolesTable'];
					$userRoleTable = $_POST['userRoleTable'];

					// Clean up existing Installation
					$db->createCommand(sprintf('drop table if exists %s, %s, %s, %s, %s, %s',
								$usersTable,
								$messagesTable, 
								$profileFieldsTable, 
								$profileTable,
								$rolesTable,
								$userRoleTable
								)
							)->execute();

					// Create User Table
					$sql = "CREATE TABLE IF NOT EXISTS `" . $usersTable . "` (
						`id` int(11) NOT NULL auto_increment,
						`username` varchar(20) NOT NULL,
						`password` varchar(128) NOT NULL,
						`email` varchar(128) NOT NULL,
						`activkey` varchar(128) NOT NULL default '',
						`createtime` int(10) NOT NULL default '0',
						`lastvisit` int(10) NOT NULL default '0',
						`superuser` int(1) NOT NULL default '0',
						`status` int(1) NOT NULL default '0',
						PRIMARY KEY  (`id`),
						UNIQUE KEY `username` (`username`),
						UNIQUE KEY `email` (`email`),
						KEY `status` (`status`),
						KEY `superuser` (`superuser`)
							) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


					$db->createCommand($sql)->execute();

					// Create Messages Table
					$sql = "
						CREATE TABLE IF NOT EXISTS `" . $messagesTable . "` (
								`id` int(11) NOT NULL auto_increment,
								`from_user_id` int(11) NOT NULL,
								`to_user_id` int(11) NOT NULL,
								`title` varchar(45) NOT NULL,
								`message` text,
								`message_read` tinyint(1) NOT NULL,
								`draft` tinyint(1) default NULL,
								PRIMARY KEY  (`id`),
								KEY `fk_messages_users` (`from_user_id`),
								KEY `fk_messages_users1` (`to_user_id`)
								) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

					$db->createCommand($sql)->execute();


					// Create Profile Fields Table
					$sql = "CREATE TABLE IF NOT EXISTS `" . $profileFieldsTable . "` (
						`id` int(10) NOT NULL auto_increment,
						`varname` varchar(50) NOT NULL,
						`title` varchar(255) NOT NULL,
						`field_type` varchar(50) NOT NULL,
						`field_size` int(3) NOT NULL default '0',
						`field_size_min` int(3) NOT NULL default '0',
						`required` int(1) NOT NULL default '0',
						`match` varchar(255) NOT NULL,
						`range` varchar(255) NOT NULL,
						`error_message` varchar(255) NOT NULL,
						`other_validator` varchar(255) NOT NULL,
						`default` varchar(255) NOT NULL,
						`position` int(3) NOT NULL default '0',
						`visible` int(1) NOT NULL default '0',
						PRIMARY KEY  (`id`),
						KEY `varname` (`varname`,`visible`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";

					$db->createCommand($sql)->execute();


					// Create Profiles Table
					$sql = "CREATE TABLE IF NOT EXISTS `" . $profileTable . "` (
						`profile_id` int(11) NOT NULL auto_increment,
						`user_id` int(11) NOT NULL,
						`lastname` varchar(50) NOT NULL default '',
						`firstname` varchar(50) NOT NULL default '',
						`about` text,
						`street` varchar(255),
						PRIMARY KEY  (`profile_id`),
						KEY `fk_profiles_users` (`user_id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

					$db->createCommand($sql)->execute();

					// Create Roles Table
					$sql = "CREATE TABLE IF NOT EXISTS `".$rolesTable."` (
						`id` INT NOT NULL AUTO_INCREMENT ,
						`title` VARCHAR(255) NOT NULL ,
						`description` VARCHAR(255) NULL ,
						PRIMARY KEY (`id`)) 
							ENGINE = InnoDB; ";

					$db->createCommand($sql)->execute();

					// Create User_has_role Table

					$sql = "CREATE TABLE IF NOT EXISTS `".$userRoleTable."` (
						`id` int(11) NOT NULL auto_increment,
						`user_id` int(11) NOT NULL,
						`role_id` int(11) NOT NULL,
						PRIMARY KEY  (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

					$db->createCommand($sql)->execute();

					if($this->module->installDemoData) 
					{
						$sql = "INSERT INTO `".$usersTable."` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES
							(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '', 0, 1266571424, 1, 1),
							(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '', 0, 1266543330, 0, 1)";
						$db->createCommand($sql)->execute();
						$sql = "INSERT INTO `".$profileTable."` (`profile_id`, `user_id`, `lastname`, `firstname`) VALUES
							(1, 1, 'admin','admin'),
							(2, 2, 'demo','demo')";
						$db->createCommand($sql)->execute();

					}

					// Do it
					$transaction->commit();

					// Victory
					$this->render('success');
				} 
				else 
				{
					throw new CException(Yii::t('UserModule.user', 'Database Connection is not working'));	
				}
			}
			else {
				$this->render('start');
			}
		} else {
			throw new CException(Yii::t('UserModule.user', 'User management Module is not in Debug Mode'));	
		}
	}

	public function actionIndex()
	{
		$this->actionInstall();
	}
}
