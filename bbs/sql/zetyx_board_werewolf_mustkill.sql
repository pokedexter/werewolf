-- phpMyAdmin SQL Dump
--
-- ���̺��� ���� ������ `zetyx_board_werewolf_mustkill`
--

-- http://www.phpmyadmin.net
--
-- ȣ��Ʈ: localhost
-- ó���� �ð�: 17-08-26 00:21 
-- ���� ����: 4.0.22
-- PHP ����: 4.4.9p2


--
-- �����ͺ��̽�: `werewolf6`
--

-- --------------------------------------------------------

--
-- ���̺� ���� `zetyx_board_werewolf_mustkill`
--

CREATE TABLE IF NOT EXISTS `zetyx_board_werewolf_mustkill` (
  `game` int(20) unsigned NOT NULL DEFAULT 0,
	`day` tinyint(5) unsigned NOT NULL DEFAULT 0,
	`target` int(20) unsigned NOT NULL DEFAULT 0
) TYPE=MyISAM;