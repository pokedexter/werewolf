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
# ���̺� ���� `zetyx_board_werewolf_guard`
#

CREATE TABLE `zetyx_board_werewolf_guard` (
  `game` int(20) unsigned NOT NULL default '0',
  `day` tinyint(5) unsigned NOT NULL default '0',
  `hunter` int(20) unsigned NOT NULL default '0',
  `purpose` int(20) unsigned NOT NULL default '0',
  `result` varchar(7) default NULL
) TYPE=MyISAM;

