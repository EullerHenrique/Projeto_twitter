$(() => {


    //Script para desativar o botão de submit se o textarea estiver vazio
    $("#btn").attr("disabled", true);
    $("#tweet").keyup(function() {

        if($("#tweet").val().trim() === ''){
            $("#btn").attr("disabled", true);
        }else{
            $("#btn").attr("disabled", false);
        }

    });



    //Script para desativar o botao de submit se o input estiver vazio
    $("#file2").change(function() {
            $("#btn").attr("disabled", false);
    });


    //Script para impedir que seja possível fazer diversas requisições ao clicar inúmeras vezes
    //no botão de um formulário

    $('#form2').submit(function (){
        $('#btn').attr('disabled', true);
    });

    //Exibe o arquivo antes dele ser enviado
    $("#file2").change(function(e) {   //change() -> O evento de alteração do jQuery ocorre quando o valor de um
                                      // elemento é alterado. Funciona apenas em campos de formulário. Quando
                                     //o evento change ocorre, o método change () anexa uma função a ele para executar.
                                    //Este evento é limitado aos elementos <input>, <textarea> e <select>.

        //This vs e.target = "this" sempre se refere à sua div, enquanto "e.target" faz referência
        //a um elemento em que você clicou na div.
        //console.log(e);
        //console.log(e.target.files);
        //console.log(this);

        var nome = e.target.files[0]["name"];
        var tamanho = this.files[0]["size"];
        console.log(tamanho);
        var tamanhoMaximo = 1024 * 1024 * 2; //2mb


        if((nome.indexOf(".png") >= 0 || nome.indexOf(".jpg") >= 0|| nome.indexOf(".jpeg") >= 0|| nome.indexOf(".gif") >=0) && tamanho < tamanhoMaximo) {

                if (this.files && this.files[0]) { //Verifica se os atributos existem, ou seja, se tais atributos possuem valores

                        var reader = new FileReader();

                         reader.readAsDataURL(this.files[0]);    //FileReader.readAsDataURL () converte o nome do arquivo
                                                                 //em uma string grande (na forma de "data: image/jpeg;base64,
                                                                 //4SVaRXhpZgAAS ..... . ")


                        reader.onload = function (e) { // On load é acionado quando uma leitura é concluída com êxito.
                        // Quando a leitura é realizada
                        $('#img').attr('src', e.target.result);              //O atributo src do elemento img recebe a URL
                                                                             //da imagem gerado pelo o objeto FileReader
                                                                             //(ex: data:image/png;base64,iVBORw0KGgo.......)
                        $('#img').attr('width','80px').attr('height','80px');
                        };
                }
        }else{
            $('#img').attr('src', "IMG/error.png");
            $('#img').attr('width','80px').attr('height','80px');
            $('#btn').attr('disabled',true);
        }


        });

        //Script para contar quantos caracteres o usuário digitou e exibir essa contagem

        $("#tweet").keyup(function (e) {
            var cont = $("#tweet").val().length;
            console.log(cont);
            $("#cont").text(cont);
        });


        $("#tweet").keydown(function (e) {
            var cont = $("#tweet").val().length;
            console.log(cont);
            $("#cont").text(cont);
        });




});

