$(".cancelModalAddMateri, .cancelModalEditMateri").on("click", function () {
    $(".modalAdminMateri")[0].reset();
    $(
        "#formModalAdminMateri #title, #formModalAdminMateri #image, #formModalAdminMateri #audio, #formModalAdminMateri #category, #formEditModalAdminMateri #titleEdit, #formEditModalAdminMateri #imageEdit, #formEditModalAdminMateri #audioEdit, #formEditModalAdminMateri #categoryEdit"
    ).removeClass("is-invalid");
    $(
        "#formModalAdminMateri #title, #formModalAdminMateri #image, #formModalAdminMateri #audio, #formModalAdminMateri #category, #formEditModalAdminMateri #titleEdit, #formEditModalAdminMateri #imageEdit, #formEditModalAdminMateri #audioEdit, #formEditModalAdminMateri #categoryEdit"
    ).removeClass("invalid-feedback");
    $("#formModalAdminMateri #title, #formModalAdminMateri #category").val("");
});

$(".buttonEditMateri").on("click", function () {
    const code = $(this).data("code-materi");
    const title = $(this).data("title-materi");
    const category = $(this).data("category-materi");
    const text = $(this).data("text-materi"); 

    if (category == "past_simple_regular_verbs") { 
        $("#past_simple_regular_verbs").attr("selected", true);
    } else if (category == "past_simple_irregular_verbs") {
        $("#past_simple_irregular_verbs").attr("selected", true);
    } else if (category == "past_continuous") {
        $("#past_continuous").attr("selected", true);
    } else if (category == "past_perfect") {
        $("#past_perfect").attr("selected", true);
    } else {
        $("#storytelling").attr("selected", true);
    }

    $(".codeMateri").val(code);
    $("#titleEdit").val(title);
    $("#textEdit").val(text);
    $("#textEditQuill").html(text);
    $("#formEditModalAdminMateri").modal("show");
});

$(".buttonDeleteMateri").on("click", function () {
    const data = $(this).data("title-materi");
    const code = $(this).data("code-materi");
    $(".materiMessagesDelete").html(
        "Are you sure you want to delete this lesson with name <strong>'" +
            data +
            "'</strong> ?"
    );
    $(".codeMateri").val(code);
    $("#deleteMateriConfirm").modal("show");
});
