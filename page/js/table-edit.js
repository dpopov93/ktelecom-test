$(function () {

    function revert() {
        $("#table-partners .editfield").each(function () {
            var $td = $(this).closest('td');
            $td.empty();
            $td.text($td.data('oldText'));
            $td.data('editing', false);
        });
    }

    function save($input) {
        var val = $input.val();
        var $td = $input.closest('td');
        $td.empty();
        $td.text(val);
        $td.data('editing', false);
    }


    $('#table-partners td').on('keyup', 'input.editfield', function (e) {
        if (e.which == 13) {
            // save
            $input = $(e.target);
            save($input);
        } else if (e.which == 27) {
            // revert
            revert();
        }
    });

    $("#table-partners td").click(function (e) {
        // consuem event
        e.preventDefault();
        e.stopImmediatePropagation();

        $td = $(this);

        // if this element not allow to edit
        if ($td.attr('class') == 'no-editable') {
            console.debug("THIS!");
            return;
        }

        // if already editing, do nothing.
        if ($td.data('editing')) return;
        // mark as editing
        $td.data('editing', true);

        // get old text
        var txt = $td.text();

        // store old text
        $td.data('oldText', txt);

        // make input
        var $input = $('<input type="text" class="editfield">');
        $input.val(txt);

        // clean td and add the input
        $td.empty();
        $td.append($input);
    });


    $(document).click(function (e) {
        revert();
    });
});
