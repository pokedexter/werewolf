# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �������� 31�� PM 04:04 
# ���� ����: 4.00.22
# PHP ����: 4.4.1
# �����ͺ��̽� : `werewolf2`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_comment_werewolf_commentType`
#

CREATE TABLE `zetyx_board_comment_werewolf_commentType` (
  `game` int(20) NOT NULL default '0',
  `comment` int(11) NOT NULL default '0',
  `type` varchar(20) default '0',
  `character` int(20) NOT NULL default '0'
) TYPE=MyISAM;


