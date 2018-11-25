$(function () {
    var text_count=$("#address");
    text_count.keypress(function(event) {
        var txtWidth =this.value.length;
        document.getElementById("paragraph").innerHTML=txtWidth;

    });
    text_count.keyup(function(event) {
        var txtWidth =this.value.length;
        document.getElementById("paragraph").innerHTML=txtWidth;
    });
});

// function countpl() {
//     alert("guru");
//     var txtWidth =this.value.length;
//     document.getElementById("paragraph").innerHTML=txtWidth;
//
// });
//
// function countmn() {
//     var txtWidth =this.value.length;
//     document.getElementById("paragraph").innerHTML=txtWidth;
// });
function getState(listindex)
{
    document.getElementById("ddlCity").options.length = 0;
    switch (listindex)
    {
        case "india":
            var state= document.getElementById("ddlCity");
            state.options[0] = new Option("--select--", "");
            state.options[1] = new Option("Karnartaka", "Karnartaka");
            state.options[2] = new Option("Tamilnadu", "Tamilnadu");
            state.options[3] = new Option("Delhi", "Delhi");
            state.options[4] = new Option("Goa", "Goa");

            break;

        case "usa":
            var state= document.getElementById("ddlCity");
            state.options[0] = new Option("--select--", "");
            state.options[1] = new Option("Washington ", "Washington ");
            state.options[2] = new Option("New York ", "New York ");

            break;
    }

}
function mobile(countryvalue) {

    var mobile_pre = document.getElementById("mobile");
    switch (countryvalue)
    {
        case "india":
                       mobile_pre.innerHTML="+91";
            break;

        case "usa":
            mobile_pre.innerHTML="+1";
            break;
    }
}

// function pincode(country) {
//     var mobile_pre = document.getElementById("pincode");
//     switch (countryvalue)
//     {
//         case "india":
//             if (mobile_pre.value!= 6)
//             {
//                 alert("invalid pincode");
//             }
//             break;
//
//         case "usa":
//             mobile_pre.innerHTML="+1";
//             break;
//     }
// }