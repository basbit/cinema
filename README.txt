=========== REST-�������� API ��� ������� ������� � ���� ============

Framework: Yii, v1.1.14
BD: mysql

@author		baster
@author mail	g-serg88@yandex.ru


��� ��������� ���� ������ ���������� ������� �� cinema, 
����������� � ��������� ������� �� ����� /cinema/protected/data/cinema.sql
������� ������������ � ������ � ����� /cinema/protected/config/main.php

-----------------------------------------------------------------------------------------------------

�������� ���������� ����������, � ������������ ���������� �� ����:

/cinema?id=1&hall=1

// id - ������������ �������� (id ����������), ��� �� ���� ����������� ������� 
	������ id ��������� ��� ��������� (�������� �������� �� name)
	��� ������� alias (�������� �� ��������)
// hall - �� ������������ ��������, ��������� ��� ������ ���� ������� ����������

��������� ����������: ������������� ������ � ������������ ������� � ����� ����������� � ������� JSON
-----------------------------------------------------------------------------------------------------

����� ����������� � ����� �����������/����� ��� ���������� �����:

/cinema/film?name=Star%20Trek

// id - ������������ �������� (id �����), ��� �� ���� ����������� ������� 
	������ id ������ ��� ��������� (�������� �������� �� name)

��������� ����������: ������������� ������ � ����������� �� ���������� ����� � ������� JSON
-----------------------------------------------------------------------------------------------------

����� ���������, ����� ����� �������� �� ���������� �����:

/cinema/film/places?id=1_4_5_15


// id - ������������ �������� (���������, ������� �� id ����������, id �����, id ������, id ����������), 
	������� ��� id ������ ������ �� ������������� ������

��������� ����������: ������������� ������ �� ���������� ������� ��� ����������� ������ � ������� JSON 
-----------------------------------------------------------------------------------------------------

��� ������� ������:

/cinema/ticket/buy?id=20&places=1,2,3,4&row=5

// id - ������������ �������� (id ����������), ����� ����� �� ������ ������� �������������� ����������� (seduleId)
// places - ������������ �������� - ���������� �����. ����� ������� ��������� ���� ����� �������.
// row - ������������ �������� - ����� ����.

��������� ����������: ������������ md5 ����� (�� id ����������, id ����������, id �����, id ������, id ����� � ���� 
(������� ����� � ��������)) ����� ������ ������������� (_) ������������� ���������� base64. ������������ � ������� JSON
-----------------------------------------------------------------------------------------------------

����� �������� �������, �� �� ������, ��� �� ��� �� ������ ������:

/cinema/ticket/reject?code=Njg4ZDAwZTRiNzM2N2Y1NzRhYjRlODZkODNiYWQxZTJfXzA3NjNkZjY3NjFmOWFjZmIxYTY3MGE5ZjVlMWEyYjRjX19mNDM1NGU0Mzk2ODYxOTdiZTgxYzAyZTFmNWNiNTczNF9fMTQ4MjBkODdjZTk4ZTYxZjQ2Y2RhZGRiZGJjMGE0ZTU=

// code - ������������ �������� - ���������� ��� ��������� �������, ������� �� ������ ���������� �������.


��������� ����������: ��������� �� ������ �� ��������� ������� � �� �����������, 
���� ��������� � �� ����������� �������� �������. ������������ � ������� JSON
-----------------------------------------------------------------------------------------------------
