# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �ŵ�� 21�� PM 04:18 
# ���� ����: 4.00.26
# PHP ����: 4.4.7p1
# �����ͺ��̽� : `werewolf5`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_entry`
#

CREATE TABLE `zetyx_board_werewolf_entry` (
  `no` int(20) unsigned NOT NULL auto_increment,
  `game` int(20) unsigned NOT NULL default '1',
  `vote` int(1) unsigned NOT NULL default '0',
  `name` varchar(20) default NULL,
  `player` int(20) unsigned NOT NULL default '0',
  `character` int(20) unsigned NOT NULL default '0',
  `truecharacter` int(20) unsigned NOT NULL default '0',
  `victim` int(1) unsigned NOT NULL default '0',
  `alive` varchar(10) NOT NULL default '����',
  `deathday` int(6) default '0',
  `deathtype` varchar(10) default NULL,
  `comment` int(1) unsigned NOT NULL default '0',
  `suddenCount` int(1) unsigned NOT NULL default '0',
  `normal` int(8) unsigned NOT NULL default '20',
  `memo` int(8) unsigned NOT NULL default '10',
  `secret` int(8) unsigned NOT NULL default '40',
  `grave` int(8) unsigned NOT NULL default '20',
  `telepathy` int(8) unsigned NOT NULL default '1',
  `ip` varchar(15) default NULL,
  `isConfirm` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`no`)
) TYPE=MyISAM;


ALTER TABLE  `zetyx_board_werewolf_entry` ADD  `seal` INT( 1 ) UNSIGNED NOT NULL DEFAULT  '1';
ALTER TABLE  `zetyx_board_werewolf_entry` ADD  `seal_vote` INT( 1 ) UNSIGNED NOT NULL DEFAULT  '0';