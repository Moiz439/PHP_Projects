$(document).ready(function (){
    $("#addMemberBtn").click(function(){
        $("#memberModal").show();
    });

    $(".close").click(function(){
        $("#memberModal").hide();
    });

    $("#addMemberForm").submit(function(e){
        e.preventDefault();
        let parent=$("#parent").val();
        let name=$("#name").val().trim();

        if(!name.match(/^[a-zA-Z\s]+$/))
        {
            alert("Name Should contain only letters!");
            return;
        }

        $.ajax({
            url: "insert.php",
            type: "POST",
            data: { parent: parent, name: name },
            success: function (response) {
                
                try {
                    let data = JSON.parse(response);
                    if (data.status === "success") {
                        let newEntry = "<li data-id='" + data.id + "'>" + name + "</li>";
                        if (parent == 0) {
                            $("#members_tree > ul").append(newEntry);
                        } else {
                            $("li[data-id='" + parent + "']").append("<ul>" + newEntry + "</ul>");
                        }
                        $("#memberModal").hide();
                        $("#addMemberForm")[0].reset();
                    } else {
                        alert("Error adding member.");
                    }
                } catch (error) {
                    console.error("Invalid JSON:", response);
                }
            }
        });
        
    });
});