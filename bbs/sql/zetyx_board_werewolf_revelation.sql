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
# ���̺� ���� `zetyx_board_werewolf_revelation`
#

CREATE TABLE `zetyx_board_werewolf_revelation` (
  `game` int(20) unsigned NOT NULL default '0',
  `day` tinyint(5) unsigned NOT NULL default '0',
  `type` varchar(10) default NULL,
  `prophet` int(20) unsigned NOT NULL default '0',
  `mystery` int(20) unsigned NOT NULL default '0',
  `result` tinyint(1) unsigned NOT NULL default '0'
) TYPE=MyISAM;

