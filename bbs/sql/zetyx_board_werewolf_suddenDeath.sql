# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �������� 31�� PM 04:03 
# ���� ����: 4.00.22
# PHP ����: 4.4.1
# �����ͺ��̽� : `werewolf2`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_suddenDeath`
#

CREATE TABLE `zetyx_board_werewolf_suddenDeath` (
  `no` int(20) unsigned NOT NULL auto_increment,
  `game` int(20) unsigned NOT NULL default '0',
  `name` varchar(20) default NULL,
  `player` int(20) unsigned NOT NULL default '0',
  `character` int(20) unsigned NOT NULL default '0',
  `truecharacter` int(20) unsigned NOT NULL default '0',
  `deathday` tinyint(4) unsigned NOT NULL default '0',
  `ip` varchar(15) default NULL,
  `reg_data` int(13) default NULL,
  PRIMARY KEY  (`no`)
) TYPE=MyISAM;

