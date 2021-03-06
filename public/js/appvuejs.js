new Vue({

    /** Elemento */
    el: '#vue',

    /** Inputs */
    data: {
        cep: '',
        endereco: {},
        naoLocalizado: false
    },

    attached: function(){
        //jQuery(this.$$.cep).mask('99999-999');
    },

    methods: {
        buscar: function(){

            //console.log(this.cep);

            if(/^[0-9]{5}-[0-9]{3}/.test(this.cep)){

                var self = this; //preservando o scopo (endereço)

                self.endereco = {};
                self.naoLocalizado = false;

                jQuery.getJSON('http://viacep.com.br/ws/'+this.cep+'/json/', function(endereco){

                    if(endereco.erro){
                        jQuery(self.$$.logradouro).focus();
                        self.naoLocalizado = true;
                        return;
                    }

                    self.endereco = endereco;
                    jQuery(self.$$.numero).focus();
                });
            }
        }
    }
});