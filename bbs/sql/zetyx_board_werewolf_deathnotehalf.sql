# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �ŵ�� 21�� PM 04:24 
# ���� ����: 4.00.26
# PHP ����: 4.4.7p1
# �����ͺ��̽� : `werewolf5`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_deathnotehalf`
#

CREATE TABLE `zetyx_board_werewolf_deathnotehalf` (
  `game` int(20) unsigned NOT NULL default '0',
  `DAY` tinyint(5) unsigned NOT NULL default '0',
  `werewolf` int(20) unsigned NOT NULL default '0',
  `injured` int(20) unsigned NOT NULL default '0'
) TYPE=MyISAM;
