/*************************************
  MAIN JS
**************************************/


// �ʱ�ȭ
function init2() {
	chk_bug();
}

// �޴� �¿���
function open_bug(chk_num) {
	for(i=1; i<=5; i++) {
		if("0"+i == chk_num) {
			document.getElementById("sub00" + i).style.display = "";
		}
		else {
			document.getElementById("sub00" + i).style.display = "none";
		}
	}
	set_mccookie(chk_num);
}

// ��Ű ���� �� �б�
function set_mccookie(chk_num) {
	document.cookie = "open_bug=" + escape(chk_num) + ";path=/";
}

function get_mccookie(cname) {
	var ck = document.cookie;
	var cookie_val = "";
	if(ck.indexOf(cname+"=") != -1) {
		ck = ck.split(";");
		for(var i=0; i<ck.length; i++) {
			if(ck[i].indexOf(cname+"=") != -1) {
				cookie_val = unescape(ck[i].split("=")[1]);
				break;
			}
		}
	}
	return cookie_val;
}

// ������ �ε��� ��Ű üŷ
function chk_bug() {
	var chk_num = get_mccookie("open_bug");
	chk_num = chk_num ? chk_num : "01";
	open_bug(chk_num);
}


