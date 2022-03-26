( function () {
  'use strict'

    let objMedicacao = {
          nomeMedicacao: '',
          via: '',
          horario: ''
      };

    let radioButton = {
      via: '',
      horario: ''
    }


      //Limpando a sessionStorage relacionada a prescrição médica, caso tenha em armazenamento.
      window.sessionStorage.removeItem('dieta');
      window.sessionStorage.removeItem('medicacoes');
      window.sessionStorage.removeItem('outros');

      //Capturando o elemento <tbody>
      let tbody = document.getElementById("tbody");

      //Capturando todos os inputs(radioButtons) que possuem o atributo name="radiosVia". E adicionando evento 'click' nestes radiosButtons.
      document.querySelectorAll('input[name="radiosVia"]').
        forEach( item => { item.addEventListener( 'click', function (){

            objMedicacao.via = item.value;

            radioButton.via = item;

        }   )});


      //Capturando todos os inputs(radioButtons) que possuem o atributo name="radiosHorario". E adicionando evento 'click' nestes radiosButtons.
      document.querySelectorAll('input[name="radiosHorario"]').
        forEach( item => { item.addEventListener( 'click', function (){

            objMedicacao.horario = item.value;

            radioButton.horario = item;

        }   )});



      //Adicionando evento 'click' no Botão relacionado a dieta
      document.getElementById('btn_add_dieta').addEventListener('click', function () {
        
        if(!document.getElementById('inputDieta').value) return;

        window.sessionStorage.setItem('dieta', document.getElementById('inputDieta').value);

        document.getElementById('inputDieta').value = '';

        imprimirItensPrescritos();


      });



      //Adicionando evento 'click' no Botão relacionado a medicação
      document.getElementById('btn_add_medicacao').addEventListener('click', function () {
        
        if(!document.getElementById('inputMedicacao').value || !objMedicacao.via || !objMedicacao.horario)
        {
          document.getElementById('avisoMedicacao').innerHTML = `<p><span class="text-danger border rounded border-danger px-2">Informe o Nome, Via e Horário da medicação</span></p>`;
          
          return;

        } else {
          document.getElementById('avisoMedicacao').innerHTML = '';
        }

        objMedicacao.nomeMedicacao = document.getElementById('inputMedicacao').value;
        
        if(window.sessionStorage.getItem('medicacoes'))
        {
          let medicacoes = JSON.parse(window.sessionStorage.getItem('medicacoes'));

          medicacoes.push(objMedicacao);

          window.sessionStorage.setItem('medicacoes', JSON.stringify(medicacoes));
        
        } else {

          window.sessionStorage.setItem('medicacoes', JSON.stringify([objMedicacao]));

        }

        imprimirItensPrescritos();

        //limpando o input e os radioButtons clicados
        document.getElementById('inputMedicacao').value = '';
        radioButton.via.checked = false;
        radioButton.horario.checked = false;
        objMedicacao.via = '';
        objMedicacao.horario = '';


      });

      //Adicionando evento 'click' no Botão relacionado ao campo Outros
      document.getElementById('btn_add_outros').addEventListener('click', function () {
        
        if(!document.getElementById('inputOutros').value) return;

        if(window.sessionStorage.getItem('outros'))
        {
          let outros = JSON.parse(window.sessionStorage.getItem('outros'));

          outros.push(document.getElementById('inputOutros').value);

          window.sessionStorage.setItem('outros', JSON.stringify(outros));
        
        } else {

          window.sessionStorage.setItem('outros', JSON.stringify([document.getElementById('inputOutros').value]));

        }

        document.getElementById('inputOutros').value = '';

        imprimirItensPrescritos();

      });


      function imprimirItensPrescritos()
      {
        let html = '';
        let indice = 0;
        tbody.innerHTML = '';

        //Imprimindo o item dieta
        let dieta = window.sessionStorage.getItem('dieta');
        if (dieta) {

           html += `<tr>
                    <td>
                      ${++indice}. Dieta ${dieta} 
                    </td>
                    <td></td>
                      <td class="text-center"><button onclick="deletarItem('dieta')" class="btn btn-danger" type="button" title="Deletar item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg></button></td>
                    </tr>`
        }


        //Imprimindo os itens medicações
        let medicacoes = JSON.parse(window.sessionStorage.getItem('medicacoes'));
        
        if(medicacoes) {

          for(let [index, medicacao] of medicacoes.entries()) {

            let arrayHorario = medicacao.horario.split('-');

            html += `<tr>
                      <td>
                        ${++indice}. ${medicacao.nomeMedicacao} ${medicacao.via} ${arrayHorario[0]}
                      </td>
                      <td>
                        ${arrayHorario[1]}
                      </td>
                      <td class="text-center"><button onclick="deletarItem('medicacao', ${index})" class="btn btn-danger" type="button" title="Deletar item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg></button></td>
                    </tr>`
          }
        }


        //Imprimindo os itens outros
        let outros = JSON.parse(window.sessionStorage.getItem('outros'));
        
        if (outros) {

          for(let [index, itemOutro] of outros.entries()) {
           
           html += `<tr>
                    <td>
                      ${++indice}. ${itemOutro} 
                    </td>
                    <td></td>
                      <td class="text-center"><button onclick="deletarItem('outro', ${index})" class="btn btn-danger" type="button" title="Deletar item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg></button></td>
                    </tr>`
          }
        }


          tbody.innerHTML += html;
      }


      function deletarItem(tipo, index)
      {
        switch(tipo) {
          case 'dieta':
                window.sessionStorage.removeItem('dieta');
                imprimirItensPrescritos();
            break;
          case 'medicacao':
                let medicacoes = JSON.parse(window.sessionStorage.getItem('medicacoes'));
                medicacoes.splice(index,1);
                window.sessionStorage.setItem('medicacoes', JSON.stringify(medicacoes));
                imprimirItensPrescritos();
            break;
          case 'outro':
                let outros = JSON.parse(window.sessionStorage.getItem('outros'));
                outros.splice(index,1);
                window.sessionStorage.setItem('outros', JSON.stringify(outros));
                imprimirItensPrescritos();
            break;
        }

      }

    //Adicionando a function deletarItem() ao escopo global. Senão, esta function, no atributo onclick="" do Botão deletar, não será encontrada.
    window.deletarItem = deletarItem;


})()