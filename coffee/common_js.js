function onReady()
{
	alert("준비 중 입니다.");
}









function addMenu(menu)
{
	// 주문 테이블을 가져온다.
	var orderTable = document.getElementById('order_table');
	
	// 테이블의 행개수를 가져온다.
	var totalCount = orderTable.rows.length;
	var rows = orderTable.rows;
	
	var isExist = false;
	
	for( var i = 0; i < totalCount; i++ )
	{
		// 테이블에 이미 메뉴가 추가된 상태라면 수량과 가격만 바꿔준다.
		if( rows[i].cells[0].innerHTML == menu.value )
		{
			var count = rows[i].cells[1].innerHTML;
			count = count.toString();
			count = parseInt(count);
			count++;
			rows[i].cells[1].innerHTML = count;
			isExist = true;
			break;
		}
	}
	
	// 새로운 메뉴를 클릭하면 테이블에 한 행을 추가한다.
	if( !isExist )
	{
		var newRow = orderTable.insertRow(totalCount);
		
		// 추가한 행에 메뉴, 수량, 가격 필드를 추가한다.
		var menuCell = newRow.insertCell(0);
		var countCell = newRow.insertCell(1);
		var priceCell = newRow.insertCell(2);
		
		// 각 필드의 값을 설정한다.
		menuCell.innerHTML = menu.value;
		countCell.innerHTML = 1;
		priceCell.innerHTML = 3500;
	}
	
	// 총금액을 계산한다.
	totalCount = orderTable.rows.length;
	var sum = 0;
	for( var i = 1; i < totalCount; i++ )
	{
		var price = rows[i].cells[2].innerHTML;
		price = price.toString();
		price = parseInt(price);
		sum += price;
	}
	
	document.getElementById('sum').value = sum;
}

// 메뉴 카테고리를 바꿔주는 함수
function changeCategory(cat)
{
	var menu = document.getElementById('menu');
	var menuTable="";
	
	if(cat.value == 'ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=에스프레소 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=아메리카노 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=카페라떼 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=카푸치노 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=바닐라라떼 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='캬라멜 마키야또' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='카페모카' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='화이트모카' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='민트모카' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'NON-ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=논에스프레소1 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논에스프레소2 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논에스프레소3 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논에스프레소4 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=논에스프레소5 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논에스프레소6 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논에스프레소7 onclick=addMenu(this)></td>";
		menuTable += "<td></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'ICE-ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='아이스 에스프레소' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='아이스 아메리카노' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='아이스 카페라떼' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='아이스 카푸치노' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='아이스 바닐라라떼' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='아이스 캬라멜 마키야또' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='아이스 카페모카' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='아이스 화이트모카' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='아이스 민트모카' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'ICE-NON-ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=논아이스에스프레소1 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논아이스에스프레소2 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논아이스에스프레소3 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논아이스에스프레소4 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=논아이스에스프레소5 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논아이스에스프레소6 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=논아이스에스프레소7 onclick=addMenu(this)></td>";
		menuTable += "<td></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'ADE')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=에이드1 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=에이드2 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=에이드3 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=에이드4 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=에이드5 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=에이드6 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=에이드7 onclick=addMenu(this)></td>";
		menuTable += "<td></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	
	menu.innerHTML = menuTable;
}

function makeSubmitForm()
{
	// 주문 테이블을 가져온다.
	var orderTable = document.getElementById('order_table');
	// 테이블의 행개수를 가져온다.
	var totalCount = orderTable.rows.length;
	var rows = orderTable.rows;
	
	// 폼을 생성할 위치 지정
	var f = document.getElementById('form');
	
	// 테이블에 있는 값으로 폼 생성
	for( var i = 1; i < totalCount; i++ )
	{
		var menu = rows[i].cells[0].innerHTML;
		var count = rows[i].cells[1].innerHTML;
		
		f.innerHTML += "<input type=hidden name=menu" + i + " value='" + menu + "'>";
		f.innerHTML += "<input type=hidden name=count" + i + " value='" + count + "'>";
	}
	
	f.submit();
}



