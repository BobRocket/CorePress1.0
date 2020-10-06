document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.corepress-code-pre code').forEach((block) => {
        hljs.highlightBlock(block);

    });

});
$('.corepress-code-pre').append('<div class="code-bar"><button class="code-bar-btm-copy">复制</button></div>')
$(".corepress-code-pre code").each(function () {
    $(this).html("<ul class='hijs-line-number'><li>" + $(this).html().replace(/\n/g, "\n</li><li>") + "\n</li></ul>");
});