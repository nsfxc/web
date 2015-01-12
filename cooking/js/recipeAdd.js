
        function addIng(){
            var rowLength=$("#tableing tr").length;
            var rowId=rowLength; 
            var newTr = tableing.insertRow();   
            var newTd0 = newTr.insertCell();  
            var newTd1 = newTr.insertCell();  
            var newTd2 = newTr.insertCell();  
            newTd0.innerHTML = "<input type='text' name='ing"+rowId+"' id='ing"+rowId+"' form='myform'/>";   
            newTd1.innerHTML = "<input type='text' name='amount"+rowId+"' id='amount"+rowId+"' form='myform'/>";  
            newTd2.innerHTML= "<input class='btn btn-default' type='button' name='delete"+rowId+"' id='delete"+rowId+"' value='delete' onclick='deleteRow(\""+rowId+"\")'/>";
        } 
        function deleteRow(rowId){
            tableing.deleteRow(rowId);
            var l=$("#tableing tr").length+1;
            var k=parseInt(rowId)+1;
            for(var i=k;i<l;i++){
                var ing="ing"+i.toString();
                var amount="amount"+i.toString();
                var delet="delete"+i.toString();
                var ingobj=document.getElementById(ing);
                var amountobj=document.getElementById(amount);
                var deleteobj=document.getElementById(delet);
                var j=i-1;
                var newid="ing"+j.toString();
                var newamount="amount"+j.toString();
                var newdelete="delete"+j.toString();
                var newclick="deleteRow("+j.toString()+")";
                ingobj.setAttribute("id",newid);
                ingobj.setAttribute("name",newid);
                amountobj.setAttribute("id",newamount);
                amountobj.setAttribute("name",newamount);
                deleteobj.setAttribute("id",newdelete);
                deleteobj.setAttribute("name",newdelete);
                deleteobj.setAttribute("onclick",newclick);
            }
        }
