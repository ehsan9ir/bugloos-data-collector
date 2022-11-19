function tinymce_setup_callback(editor)
{
    editor.contentStyles = ["body,p,div,li,ol,dl,td,em,pre,td{direction: rtl !important;unicode-bidi: inherit !important;}"];
}
function tinymce_init_callback(editor)
{
    // editor.contentCSS = [
    //     "/css/custom-voyager.css",
    //     "https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap",
    //     "body { background: red; }",
    // ];
    editor.hidden = true;
    editor.rtl = true;
}