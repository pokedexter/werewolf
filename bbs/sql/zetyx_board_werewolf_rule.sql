-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- ȣ��Ʈ: localhost
-- ó���� �ð�: 08-12-22 01:09 
-- ���� ����: 5.0.41
-- PHP ����: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- �����ͺ��̽�: `zeroboard`
-- 

-- --------------------------------------------------------

-- 
-- ���̺� ���� `zetyx_board_werewolf_rule`
-- 

CREATE TABLE `zetyx_board_werewolf_rule` (
  `no` int(20) unsigned NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  `min_player` int(10) NOT NULL default '0',
  `max_player` int(10) NOT NULL default '0',
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=5 ;

-- 
-- ���̺��� ���� ������ `zetyx_board_werewolf_rule`
-- 

INSERT INTO `zetyx_board_werewolf_rule` (`no`, `name`, `min_player`, `max_player`) VALUES 
(1, '�⺻', 11, 16),
(2, '�ܽ���', 11, 17),
(3, '�ͽ����', 9, 17),
(4, '�ŷڵ�', 11, 17);
(5, '�ν���Ʈ', 7, 8);
(6, '����', 11, 16);
