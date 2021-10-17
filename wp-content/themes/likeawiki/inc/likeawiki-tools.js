/* leaving intact incase older versions like that style
 *
 *  ====below is old toggle====
 *
    var showBtn = document.querySelector("#tools button:nth-of-type(1)"),
        hideBtn = document.querySelector("#tools button:nth-of-type(2)"),
        content = document.querySelector("#tools > div");

    // Toggle show/hide classes on test content
    showBtn.addEventListener("click", function(){
        content.className = "visible";
    }, false);

    hideBtn.addEventListener("click", function(){
        content.className = "hidden";
    }, false);
  *
  * ====ends old method====
  */

function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    } 