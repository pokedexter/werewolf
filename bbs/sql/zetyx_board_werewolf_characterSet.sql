# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �������� 31�� PM 04:01 
# ���� ����: 4.00.22
# PHP ����: 4.4.1
# �����ͺ��̽� : `werewolf2`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_characterSet`
#

CREATE TABLE `zetyx_board_werewolf_characterSet` (
  `no` int(20) unsigned NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `maker` varchar(30) NOT NULL default '',
  `ismember` int(20) NOT NULL default '0',
  `is_use` int(1) unsigned NOT NULL default '0',
  `reg_date` int(13) NOT NULL default '0',
  `mod_date` int(13) NOT NULL default '0',
  `memo` text NOT NULL,
  PRIMARY KEY  (`no`)
) TYPE=MyISAM PACK_KEYS=0;

#
# ���̺��� ���� ������ `zetyx_board_werewolf_characterSet`
#

INSERT INTO `zetyx_board_werewolf_characterSet` VALUES (1, '����� ���� �����', '�𱼵𱼴븶��', 33, 1, 0, 0, '');

