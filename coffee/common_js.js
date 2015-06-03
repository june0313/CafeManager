function onReady()
{
	alert("�غ� �� �Դϴ�.");
}









function addMenu(menu)
{
	// �ֹ� ���̺��� �����´�.
	var orderTable = document.getElementById('order_table');
	
	// ���̺��� �ళ���� �����´�.
	var totalCount = orderTable.rows.length;
	var rows = orderTable.rows;
	
	var isExist = false;
	
	for( var i = 0; i < totalCount; i++ )
	{
		// ���̺� �̹� �޴��� �߰��� ���¶�� ������ ���ݸ� �ٲ��ش�.
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
	
	// ���ο� �޴��� Ŭ���ϸ� ���̺� �� ���� �߰��Ѵ�.
	if( !isExist )
	{
		var newRow = orderTable.insertRow(totalCount);
		
		// �߰��� �࿡ �޴�, ����, ���� �ʵ带 �߰��Ѵ�.
		var menuCell = newRow.insertCell(0);
		var countCell = newRow.insertCell(1);
		var priceCell = newRow.insertCell(2);
		
		// �� �ʵ��� ���� �����Ѵ�.
		menuCell.innerHTML = menu.value;
		countCell.innerHTML = 1;
		priceCell.innerHTML = 3500;
	}
	
	// �ѱݾ��� ����Ѵ�.
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

// �޴� ī�װ��� �ٲ��ִ� �Լ�
function changeCategory(cat)
{
	var menu = document.getElementById('menu');
	var menuTable="";
	
	if(cat.value == 'ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=���������� onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=�Ƹ޸�ī�� onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=ī��� onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=īǪġ�� onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=�ٴҶ�� onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='ļ��� ��Ű�߶�' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='ī���ī' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='ȭ��Ʈ��ī' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='��Ʈ��ī' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'NON-ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=����������1 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����������2 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����������3 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����������4 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=����������5 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����������6 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����������7 onclick=addMenu(this)></td>";
		menuTable += "<td></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'ICE-ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='���̽� ����������' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='���̽� �Ƹ޸�ī��' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='���̽� ī���' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='���̽� īǪġ��' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='���̽� �ٴҶ��' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='���̽� ļ��� ��Ű�߶�' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='���̽� ī���ī' onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value='���̽� ȭ��Ʈ��ī' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value='���̽� ��Ʈ��ī' onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'ICE-NON-ESPRESSO')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=����̽�����������1 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����̽�����������2 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����̽�����������3 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����̽�����������4 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=����̽�����������5 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����̽�����������6 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=����̽�����������7 onclick=addMenu(this)></td>";
		menuTable += "<td></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	else if(cat.value == 'ADE')
	{
		menuTable += "<table>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=���̵�1 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=���̵�2 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=���̵�3 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=���̵�4 onclick=addMenu(this)></td>";
		menuTable += "</tr>";
		menuTable += "<tr>";
		menuTable += "<td><input type=button value=���̵�5 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=���̵�6 onclick=addMenu(this)></td>";
		menuTable += "<td><input type=button value=���̵�7 onclick=addMenu(this)></td>";
		menuTable += "<td></td>";
		menuTable += "</tr>";
		menuTable += "</table>";
	}
	
	menu.innerHTML = menuTable;
}

function makeSubmitForm()
{
	// �ֹ� ���̺��� �����´�.
	var orderTable = document.getElementById('order_table');
	// ���̺��� �ళ���� �����´�.
	var totalCount = orderTable.rows.length;
	var rows = orderTable.rows;
	
	// ���� ������ ��ġ ����
	var f = document.getElementById('form');
	
	// ���̺� �ִ� ������ �� ����
	for( var i = 1; i < totalCount; i++ )
	{
		var menu = rows[i].cells[0].innerHTML;
		var count = rows[i].cells[1].innerHTML;
		
		f.innerHTML += "<input type=hidden name=menu" + i + " value='" + menu + "'>";
		f.innerHTML += "<input type=hidden name=count" + i + " value='" + count + "'>";
	}
	
	f.submit();
}



