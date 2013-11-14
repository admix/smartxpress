// table sorting
$(document).ready(function() 
    { 

        var prev;
        var href;

        $("#myTable").tablesorter(); 

        $(".option").click(function(event) {
        	event.preventDefault();
        	var $this = $(this);
        	$(".option").text("Delete");
            if (prev) { prev.attr("href", href); }
            prev = $(this);
            href = $this.attr("href");
        	beg = href.indexOf("?") + 1;
        	end = href.indexOf("=");
        	rep = href.substr(0, beg) + "del" + href.substr(end);
        	$this.attr("href", rep);
            $this.text("Are you sure?").unbind();
        	$("a.option").next("a").remove(); 

        });
        }); 
  