<div class="container py-5">
    <div class="row py-5">
        <div class="col-12">
            <h4 class="margin_top text-center font-weight-bold">URLS cadastradas no sistema</h4>
            <input class="form-control margin_top" id="myInput" type="text" placeholder="Pesquise pela URL">

            <table class="table table-striped table-bordered margin_top" id="urls" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">URL</th>
                        <th scope="col">Data</th>
                        <th scope="col">Hora</th>
                        <th scope="col">StatusCode</th>
                        <th scope="col">Informações</th>

                    </tr>
                </thead>
                <tbody id="tableUrls">
                    <?php foreach ($urls as $url) { ?>
                        <tr id="dataTable">
                            <td><?= $url->url ?></td>
                            <td><?= $url->datacadastro ?></td>
                            <td><?= $url->horacadastro ?></td>
                            <td><?php if ($url->statuscode != null) {
                                        echo $url->statuscode;
                                    } else {
                                        echo 'Não processado';
                                    }  ?></td>
                            <td class="text-center"><?php if (($url->requisicaostatus) == true) { ?>
                                    <button type="button" title="Visualizar dados" class="btn btn-outline-primary font-weight-bold" data-toggle="modal" data-target="#modal<?= $url->idurl ?>">
                                        <i class="fas fa-search"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="modal<?= $url->idurl ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title mx-auto font-weight-bold" id="exampleModalLabel">Informações referentes a URL:</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row border-bottom py-3">
                                                        <div class="col-12 text-left">
                                                            <?php
                                                                    $data =  json_decode($url->conteudo);
                                                                    print_r($data);
                                                                    ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php
                                    } else {
                                        echo 'Não precessado';
                                    } ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="col-md-12 text-center">
                <ul class="pagination pagination-lg pager" id="myPager"></ul>
            </div>
        </div>
    </div>
</div>



<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function() {
        $(".search").keyup(function() {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {
                'containsi': function(elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });

            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
                $(this).attr('visible', 'false');
            });

            $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
                $(this).attr('visible', 'true');
            });

            var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

            if (jobCount == '0') {
                $('.no-result').show();
            } else {
                $('.no-result').hide();
            }
        });
    });
</script>
<script>
    $.fn.pageMe = function(opts) {
        var $this = this,
            defaults = {
                perPage: 7,
                showPrevNext: false,
                hidePageNumbers: false
            },
            settings = $.extend(defaults, opts);

        var listElement = $this;
        var perPage = settings.perPage;
        var children = listElement.children();
        var pager = $('.pager');

        if (typeof settings.childSelector != "undefined") {
            children = listElement.find(settings.childSelector);
        }

        if (typeof settings.pagerSelector != "undefined") {
            pager = $(settings.pagerSelector);
        }

        var numItems = children.size();
        var numPages = Math.ceil(numItems / perPage);

        pager.data("curr", 0);

        if (settings.showPrevNext) {
            $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
        }

        var curr = 0;
        while (numPages > curr && (settings.hidePageNumbers == false)) {
            $('<li><a href="#" class="page_link">' + (curr + 1) + '</a></li>').appendTo(pager);
            curr++;
        }

        if (settings.showPrevNext) {
            $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
        }

        pager.find('.page_link:first').addClass('active');
        pager.find('.prev_link').hide();
        if (numPages <= 1) {
            pager.find('.next_link').hide();
        }
        pager.children().eq(1).addClass("active");

        children.hide();
        children.slice(0, perPage).show();

        pager.find('li .page_link').click(function() {
            var clickedPage = $(this).html().valueOf() - 1;
            goTo(clickedPage, perPage);
            return false;
        });
        pager.find('li .prev_link').click(function() {
            previous();
            return false;
        });
        pager.find('li .next_link').click(function() {
            next();
            return false;
        });

        function previous() {
            var goToPage = parseInt(pager.data("curr")) - 1;
            goTo(goToPage);
        }

        function next() {
            goToPage = parseInt(pager.data("curr")) + 1;
            goTo(goToPage);
        }

        function goTo(page) {
            var startAt = page * perPage,
                endOn = startAt + perPage;

            children.css('display', 'none').slice(startAt, endOn).show();

            if (page >= 1) {
                pager.find('.prev_link').show();
            } else {
                pager.find('.prev_link').hide();
            }

            if (page < (numPages - 1)) {
                pager.find('.next_link').show();
            } else {
                pager.find('.next_link').hide();
            }

            pager.data("curr", page);
            pager.children().removeClass("active");
            pager.children().eq(page + 1).addClass("active");

        }
    };


    $(document).ready(function() {

        $('#myTable').pageMe({
            pagerSelector: '#myPager',
            showPrevNext: true,
            hidePageNumbers: false,
            perPage: 10
        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    function Inicio() {


        var table = document.getElementById('tableUrls');
        var conteudo = '';
        table.innerHTML = conteudo;


        $.getJSON('<?= base_url('Url/getUrls')?>', function(result) {
            console.log(result);
            result.forEach(geraHtml);
        });

        timeOutFunction();
    }

    function timeOutFunction() {

        setTimeout(Inicio, 10000);
    }

    function geraHtml(result, index) {


        var conteudo = '<tr>';
        conteudo = conteudo + '<td>' + result.url + '</td> <td>' + result.datacadastro + '</td><td>' + result.horacadastro + '</td>';
        if (result.statuscode != null) {
            conteudo = conteudo + '<td>' + result.statuscode;
        } else {
            conteudo = conteudo + '<td>' + '<b>Não processado</b>';
        }
        conteudo = conteudo + '</td> <td class="text-center">';
        if (result.requisicaostatus == '1') {
            conteudo = conteudo + '<button type="button" title="Visualizar dados" class="btn btn-outline-primary font-weight-bold" data-toggle="modal" data-target="#modal' + result.idurl + '">';
            conteudo = conteudo + '<i class="fas fa-search"></i></button>';
            conteudo = conteudo + '<div class="modal fade bd-example-modal-lg" id="modal' + result.idurl + '"tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            conteudo = conteudo + '<div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header">';
            conteudo = conteudo + '<h4 class="modal-title mx-auto font-weight-bold" id="exampleModalLabel">Informações referentes a URL:</h4>';
            conteudo = conteudo + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>';
            conteudo = conteudo + '</button></div><div class="modal-body"><div class="row border-bottom py-3"><div class="col-12 text-left">';
            conteudo = conteudo + result.conteudo + '</div></div></div><div class="modal-footer">';
            conteudo = conteudo + '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></div></div></div>';
            conteudo = conteudo + '</div>';
        } else {
            conteudo = conteudo + '<b>Não precessado</b> </td>'
        }
        conteudo = conteudo + '</tr>';

        $('#tableUrls').append(conteudo);

    }
</script>