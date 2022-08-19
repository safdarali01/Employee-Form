

jQuery(document).ready(function($){
    $('.abc').click(function(){
        var id1 = 'get-' + $(this).attr("id") + '-1';
        var id2 = 'get-' + $(this).attr("id") + '-2';
        var id3 = 'get-' + $(this).attr("id") + '-3';
        var id4 = 'get-' + $(this).attr("id") + '-4';

        $( '#first_name' ).val( $( '#'+ id1 +'' ).text() )
        $( '#last_name' ).val( $( '#'+ id2 +'' ).text() )
        $( '#email' ).val( $( '#'+ id3 +'' ).text() )
        $( '#image' ).val( $( '#'+ id4 +'' ).text() )
    });




    $('.pdf').click(function () {
            id = $(this).attr("id");

            var pid1 = 'get-' + id + '-1';
            var pid2 = 'get-' + id + '-2';
            var pid3 = 'get-' + id + '-3';
            var pid4 = 'get-' + id + '-4';

            var fname = document.getElementById(pid1).innerText
            var lname = document.getElementById(pid2).innerText
            var email = document.getElementById(pid3).innerText
            var img   = document.getElementById(pid4).firstChild.src

            to_be_print = window.open("");

            to_be_print.document.write(
                
                `<div style="padding:50px">
                    <h3>Employee Details</h3>
                    <img src="${img}" width="100" height="100"/>
                    <p>First Name : ${fname} <br>
                    <p>Last Name : ${lname} <br>
                    <p>E-mail : ${email} <br>
                </div>`

            );

            to_be_print.print();
            to_be_print.close();

        }
    );
});