# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ȣ��Ʈ: localhost
# ó���� �ð�: 2008�� �������� 31�� PM 04:00 
# ���� ����: 4.00.22
# PHP ����: 4.4.1
# �����ͺ��̽� : `werewolf2`
# --------------------------------------------------------

#
# ���̺� ���� `zetyx_board_werewolf_character`
#

CREATE TABLE `zetyx_board_werewolf_character` (
  `no` int(20) unsigned NOT NULL auto_increment,
  `set` int(20) NOT NULL default '0',
  `character` varchar(20) NOT NULL default 'no name',
  `half_image` varchar(255) NOT NULL default '',
  `greeting` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY  (`no`)
) TYPE=MyISAM;

#
# ���̺��� ���� ������ `zetyx_board_werewolf_character`
#

INSERT INTO `zetyx_board_werewolf_character` VALUES (1, 1, '���� ������ ��ī�̽�', 'ben.jpg', '���� �ɻ缼��. \r\n�̻ڰ� �̽��� ���� �����Դϴ�.\r\n\r\n���� �� ���� ��Ⱑ ���� �����ϴ�.\r\n��⸦ �ѹ� ������ �Ƿΰ� �� Ǯ����!', '�����! �ζ��� �ִٰ��?!\r\n...\r\n\r\n��� ���� �� �ɿ����� �ζ��� �ѾƳ��� Ư���� ���� ���´�ϴ�!\r\n�� �ȸ��� ���� ���� �簡����!!');
INSERT INTO `zetyx_board_werewolf_character` VALUES (2, 1, '���� ���̰���', 'daiguts.jpg', '�ȳ��ϼ���.\r\n������ �ȳ�� ������ �����ϴ� ���̰����Դϴ�.\r\n\r\n����. �ζ��� �ֳİ��?\r\n�������� ������. �ζ����� �����ϴ�.', '��ο��� �ζ��� ������ ���� �𸥴ٴ� ������ �޾ҽ��ϴ�.\r\n������ �� �𸣴� ���� ������ ������ �����ϼ���.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (3, 1, '����� �۶󸮽�', 'glaris.jpg', '���� �� ������̴�!', '�ζ��� ���� �Ϳ������� �쿩�ְھ');
INSERT INTO `zetyx_board_werewolf_character` VALUES (4, 1, 'ȸ��� �׷���', 'gray.jpg', '�� ȸ��� ���ܿ� �װھ�.', '��.. �ζ��� �ִٰ�?\r\n\r\n�䷷�� ����̱���..');
INSERT INTO `zetyx_board_werewolf_character` VALUES (5, 1, '����� ���Ϸ�', 'heilen.jpg', '���� �ݰ���. �� ������ ������ å������ ����.\r\n\r\n������ �ζ��� ���´ٴ� �ҹ� ������ �������� �������� �����̾�. ����.', '����..\r\n� ���� �� �̻��� �ҹ��� ���� �ٴϴ°� ����. ���� ������ �ڱⰡ �ζ��� �ôٰ� ��ġ�� ��ģ ���� �����ŵ�.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (6, 1, '�߱����� ����ũ��', 'hikeman.jpg', '����!! �̹� �ް� ��հ� �������� �̷� �� ������ �ͺþ�. \r\n\r\n�� �������� �ζ��̶��� ���´ٴ� �ҹ��� �ִٸ鼭?\r\n������. ����ִ� �ް��� �ǰھ�.', '��..����. ���� �Ʒ��� �־ ���� ���ư��߰ھ�.\r\n');
INSERT INTO `zetyx_board_werewolf_character` VALUES (7, 1, '��� Ȧ�׷�', 'holgren.jpg', '�ζ� ������ �����ϴ�.\r\n�ҹ��� ��鸮�� ���� ������ ���� ��Ű�ʽÿ�.', '�ζ��� �����Ѵٴ�..\r\n\r\n����. �̰��� ���� �÷��Դϴ�.\r\n����� ������ �����Ͻÿ�.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (8, 1, '������ ���̽�', 'keici.jpg', '�� ������ Ư���� �ҹ��� �ִٸ鼭?\r\n�ҹ��� ����̸� ���ڱ�.', '���� ã�Ҵ�!\r\n�̹����� �� ��� ���ھ�.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (9, 1, '���� ����', 'mu.jpg', '���̰� �����..\r\n\r\n�濡 ������ ���ξ���.. �߲�ġ�� ����..', '��? ������ �ζ��� ��Ÿ���ٰ�?\r\n\r\n������. �ζ����� ��ä���ڰ� �� ������ �Ŷ��!');
INSERT INTO `zetyx_board_werewolf_character` VALUES (10, 1, '���ġ �ǽù�', 'pcburn.jpg', '��. �ζ��� �Ƴİ�?\r\nũũũũ. �׷� ���� �ھ� ����. ũũũ.', '�� �ζ��� ��Ÿ���ٰ�?...\r\n\r\n�̹��� ���� �ҹ��� �� ����?\r\n�� ���� ��̸� ����ä�ٴ�.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (11, 1, '���� �����þ�', 'prisia.jpg', '�� ����� �Բ� �Ͻñ�.', '�ζ��� ��Ÿ���ٰ��?!\r\n\r\n���ҽý�Ʈ�� �غ��ϰڽ��ϴ�.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (12, 1, '�����ֺ� ǻ����', 'puriel.jpg', 'ȣȣȣ. �ζ��� �Ƴİ��?\r\n\r\n�׷���. ���... �̰� ����ε�.\r\n�츮 ������ �ζ����� ��ȣ�� �ְ� �����Űɿ�.', '�ƾ�. ���� �ζ����� ���� �� ������ �𸣰ڱ���.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (13, 1, '���� ����ũ', 'syurank.jpg', '�� ������ ���� ����ũ�� �Ͽ�.\r\n\r\n����. �ζ��̶�.. �ζ��� �� ������ ������ ��������.', '�ƴ� �� ������ ����̾��� ���ΰ�!\r\n\r\n�׷� �� ����. �׷� ������.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (14, 1, '��ȣ�� �ߵ���', 'valdes.jpg', '��� ��ǵ� ��ȣ�� �� �ִ� ������ ��ȣ�� �ߵ����Դϴ�.\r\n\r\n���� ��ȣ���� ���ϴ� ���̶� ���� �� ����.', '�ζ��� ���� ��ȣ�� �帮�ڽ��ϴ�.\r\n���� �ٷ� ��ȭ�ּ���.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (15, 1, 'ü������ �����', 'wolver2.jpg', '�б��� ���� ��Ų��!\r\n\r\n����� �� �ڽľ�!!', '�� �ζ��� ��Ÿ���ٰ�?\r\n...\r\n\r\n����� �� �ڽľ�!!');
INSERT INTO `zetyx_board_werewolf_character` VALUES (16, 1, '��� �����', 'ww.jpg', '�ζ��̿�?\r\n���� ���� �������ΰ���?', '�ζ� �׷��� ���� ���� ������ �ִ� �������� ¯��ſ���.\r\n�쾾 �ƺ����� �̸��ž�.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (17, 1, '���� ����Ÿ��', 'zir.jpg', 'ȣȣȣ. �������� �ҹ��� �ؾ������ ���� ��������.', '���� �ζ��� ������ �����ϴ� �� �ƴϰ���?\r\n\r\n���� �� �̸� ������ ���ڰ� �糪����. \r\n����. ������ �ζ�����...');
INSERT INTO `zetyx_board_werewolf_character` VALUES (18, 1, '����� ���丮��', '16.jpg', '��ӳ� ����� �����? \r\n�� ��Ź�մϴ�. ����', '�ൿ ���μ����� �Ͻ��� ���. \r\n������� �����մϴ� ��- ');
INSERT INTO `zetyx_board_werewolf_character` VALUES (19, 1, '������ �Ƹ���', 'aris.jpg', '�Ұ������� ���踸�� �����ϴ� �ð� ������ �Ƹ������ �ؿ�~', '��!! �� ������ ������� �ѾƿͿ�!! �����ּ���!!');
INSERT INTO `zetyx_board_werewolf_character` VALUES (20, 1, '���� ���̶�', 'benkaisy.jpg', '�� �缼��~', '�� ���� �ɵ��� ���� �١�. ����ü ���� �̷� ���� TT');
INSERT INTO `zetyx_board_werewolf_character` VALUES (21, 1, '���� ����', 'daiguta.jpg', '������ ��ȣ�ϴ� ���� �����Դϴ�! ������ �ڰ� ������ �ٷιٷ� \r\n����ҷ� �����ּ���!\r\n', '�� ���� ���� ���̰����� ������ �ȵǳ�? �� ���̶� �ֳ���');
INSERT INTO `zetyx_board_werewolf_character` VALUES (22, 1, '�����ֺ� ǻ��', 'fury.jpg', '�� �Ƴ��� ������ ������ ���� ����Ρ� ���� ������ ���ϰ� �����ϴ°� \r\n�� ���ٰ� �ϴ�����;;\r\n', '������ �Ƴ����� ���� �� �����~ ');
INSERT INTO `zetyx_board_werewolf_character` VALUES (23, 1, '����� ����', 'glassian.jpg', 'õ�� ���� Ž��. �����̶�� �մϴ�.\r\n��� ����� ���� �ذ��ϰڽ��ϴ�.', '��� ����� �˾Ҿ�!!! ��������');
INSERT INTO `zetyx_board_werewolf_character` VALUES (24, 1, 'OL �׷�����', 'graya.jpg', 'Ŀ�� �ɺθ��� ���ϴ� �׷����� �Դϴ�.', '������ ���� ���� ���� ���');
INSERT INTO `zetyx_board_werewolf_character` VALUES (25, 1, '�߱����� �Ƹ���', 'hikewoman.jpg', '���� �츮 ������ �ް��� �Դٰ� ����µ��� ', '�̰ǡ������� �߱� ��Ʈ��?');
INSERT INTO `zetyx_board_werewolf_character` VALUES (26, 1, '������ ����', 'holgrena.jpg', '�ž��� ������ ��� ���� �̰ܳ��ô�. �������� �츮�� ������ �̴ϴ�.', '���� �־�״� ���ڱ��� �� ���� ������ ���� ���� ���� �ϴµ���');
INSERT INTO `zetyx_board_werewolf_character` VALUES (27, 1, '���� �Ϸ���', 'irenu.jpg', '�� �� ��!! �� ���� ��� ��!', '���. ���� �ذ��.');
INSERT INTO `zetyx_board_werewolf_character` VALUES (28, 1, '���� �� ����', 'mumei.jpg', '����ġ�', '��� ���ִ� ��������');
INSERT INTO `zetyx_board_werewolf_character` VALUES (29, 1, '���ġ �����Ͼ�', 'pcburnne.jpg', '�� ������ �Ǵ��д� ���� �� ��� ����. Ȥ�� �� ������ �ʿ��ϸ� ������ ����~', '��? ���߾�? ����?');
INSERT INTO `zetyx_board_werewolf_character` VALUES (30, 1, '������ ������Ʈ', 'priest.jpg', '���������� �İ߳��� �߽� ������ �Դϴ�. ������ �˼������� �� ���ڰ��� �� ����\r\n���� �ֽ� �� �ֳ���? \r\n', '��.�� ���ڰ�. ȿ���� ����;; �̹��� ���� �༮�� �����Ͱ� �ƴϾ���?');
INSERT INTO `zetyx_board_werewolf_character` VALUES (31, 1, '���� ����', 'shrin.jpg', '� ������. ���� �����Դϴ�. \r\n���� ���������� ���� ���� ������.', '�� �̷��� �ٸ��� ���ô��� ���� �� ������?');
INSERT INTO `zetyx_board_werewolf_character` VALUES (32, 1, '��ȣ�� ���׽þ�', 'valdesia.jpg', '���� ���� �Ƿ��� �̷� �ð������� �˷��� �־���! ', '���� ������ �� �������� �� �̸� ���� �� ������');
INSERT INTO `zetyx_board_werewolf_character` VALUES (33, 1, 'ü������ ����', 'wolverina.jpg', '�б��� ���� ���ѿ�.', '�ű� ����ġ�� �༮!! ��� 100���� �ٰ� ��!!');
INSERT INTO `zetyx_board_werewolf_character` VALUES (34, 1, '��� ����', 'wrin.jpg', '�����þ ũ�� Ŀ�ٶ��� �׸��ڡ�', '�䳢 ������ ���� �����䡦?');
INSERT INTO `zetyx_board_werewolf_character` VALUES (35, 1, '���� ����Ÿũ', 'zirtak.jpg', '��ӳ�~ �̷� ���� ó�� ���� ���� ���ڰ�. \r\n��Ϳ�. ��ũŸũ��� �Ѵ�ϴ�. \r\n�ܻ��� �����̿���~\r\n', '�մ� ���� ����� ������ �� ��������. 140�����Դϴ�.\r\nī�� ������ �ǰɶ���? ������.\r\n');

