# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �ŵ�� 21�� PM 04:20 
# ���� ����: 4.00.26
# PHP ����: 4.4.7p1
# �����ͺ��̽� : `werewolf5`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_bigmouth`
#

CREATE TABLE `zetyx_board_werewolf_bigmouth` (
  `year` int(20) unsigned NOT NULL default '0',
  `MONTH` int(20) unsigned NOT NULL default '0',
  `player` int(20) unsigned NOT NULL default '0',
  `commentCount` int(20) unsigned NOT NULL default '0',
  `gameCount` int(20) unsigned NOT NULL default '0'
) TYPE=MyISAM;
