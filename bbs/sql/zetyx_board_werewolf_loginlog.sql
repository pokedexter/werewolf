# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �������� 31�� PM 04:02 
# ���� ����: 4.00.22
# PHP ����: 4.4.1
# �����ͺ��̽� : `werewolf2`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_loginlog`
#

CREATE TABLE `zetyx_board_werewolf_loginlog` (
  `no` int(20) unsigned NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  `ismember` int(20) unsigned NOT NULL default '0',
  `reg_date` int(13) default NULL,
  `log_date` varchar(20) default NULL,
  `ip` varchar(15) default NULL,
  PRIMARY KEY  (`no`)
) TYPE=MyISAM;


