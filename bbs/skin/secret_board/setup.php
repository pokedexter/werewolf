<!-- HTML ���� -->
<!-- �Խ��� ó���� �ۼ� �������� ������Ȳ �α��� ȸ������ ǥ�� -->
<?if($setup[use_category]){
	echo "<div align='right' class='text'>";
	include "include/print_category.php"; 
	echo "</div>";
}?>

<div align='right'>
	<?=$a_member_join?>&nbsp;join</a>
	<?=$memo_on_sound?><?=$member_memo_icon?><?=$a_member_memo?>&nbsp;memo</a>
	<?=$a_member_modify?>&nbsp;modify</a>
	<?=$a_login?>login</a>
	<?=$a_logout?>&nbsp;logout</a>
	<?=$a_setup?>&nbsp;admin</a>
</div>

