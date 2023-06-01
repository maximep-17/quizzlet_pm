
$(document).ready(function() {


  m = window.location.search.match(/\?val=(\d+)/);


  ///////////////////////////////////////////

  $("#categorie-send").submit(function(event){

    event.preventDefault();

    var $form =$(this);
    var type = $("#categorie-send").find(":selected").val();
    var titre = $form.find("input[name='titre']").val();
    var desc = $form.find("#desc").val();
    var url = $form.attr("action");
    $("select, input, textarea").attr("disabled",true);
    $("button").attr("disabled","disabled");
    $("p.errors-form").removeClass('success').removeClass('error').text("");

    $.ajax({
        type: "post",
        url: url,
        async: true,
        dataType: 'json',
        data: {
          "type": type, 
          "titre": titre,
          "desc": desc,
        },
        success: function (data) {
          $("select, input, textarea").attr("disabled",false);
          $("button").attr("disabled", false);
            if(data.response == "success") {
              $("p.errors-form").addClass('success').text("Catégorie créée.");
              modal("Catégorie crée", " Votre catégorie a été enregistrée avec succès. Vous pouvez en créer une autre en appuyant sur le bouton 'Créer à nouveau', où visualiser la liste des catégories en cliquant sur Terminé.", "Créer à nouveau", "categ_blank()", "Terminé", "categ_list()");
            }
            if(data.response == "err_saisie") {
              $("p.errors-form").addClass('error').text("Veuillez vérifier vos saisies.");
            }
        },
        error: function (data) {
          $("select, input, textarea").attr("disabled",false);
          $("button").attr("disabled", false);
          $("p.errors-form").addClass('error').text("Une erreur est survenue");
        },
    });
  });

  ///////////////////////////////////////////

  $("#question-send").submit(function(event){

    event.preventDefault();
    getPropositions = buildPropositions();

    if(getPropositions[1].length == 0) {
      $("p.errors-form").addClass('error').text("Veuillez attribuer au moins une bonne réponse.");
    }
    else {
  
      var $form =$(this);
    
      var format = $("#format-select").find(":selected").val();
      var intitule = $form.find("input[name='intitule']").val();
      var niveau = $("#niveau-select").find(":selected").val();
      var valeur_pts = $form.find("input[name='valeur_pts']").val();
      var categorie = $("#question-create-categorie").find(":selected").val();
    
      var url = $form.attr("action");
    
      $("select, input, textarea").attr("disabled",true);
      $("button").attr("disabled","disabled");
      $("p.errors-form").removeClass('success').removeClass('error').text("");
    
      $.ajax({
          type: "post",
          url: url,
          async: true,
          dataType: 'json',
          data: {
            "intitule": intitule, 
            "propositions": getPropositions[0], 
            "reponses": getPropositions[1],
            "format": format, 
            "niveau": niveau, 
            "categorie": categorie, 
            "valeur_pts": valeur_pts
          },
          success: function (data) {
            $("select, input, textarea").attr("disabled",false);
            $("button").attr("disabled", false);
              if(data.response == "success") {
                $("p.errors-form").addClass('success').text("Question ajoutée.");
                modal("Question ajoutée", " Votre question a été enregistrée avec succès. Vous pouvez en créer une autre en appuyant sur le bouton 'Créer à nouveau', où visualiser la liste des questions en cliquant sur Terminé.", "Créer à nouveau", "quest_blank()", "Terminé", "questions_list()");
              }
              if(data.response == "err_saisie") {
                $("p.errors-form").addClass('error').text("Veuillez vérifier vos saisies.");
              }
          },
          error: function (data) {
            $("select, input, textarea").attr("disabled",false);
            $("button").attr("disabled", false);
            $("p.errors-form").addClass('error').text("Une erreur est survenue");
          },
      });
    }
  });

  $("#desc-categ *").hide();
  $('#question-create-select').on('change', function() {
    $("#desc-categ *").hide();
    $("#desc-categ p#"+ this.value).fadeIn();
  });

  ///////////////////////////////////////////

  $("#test-send").submit(function(event){

    event.preventDefault();
    getQuestions = buildQuestions();
  
      var $form =$(this);
    
      var titre = $form.find("input[name='titre']").val();
      var description = $form.find("input[name='description']").val();
      var temps = $form.find("input[name='temps']").val();
      var tentatives = $form.find("input[name='tentatives']").val();
      var arrondi_note = $form.find("input[name='arrondi_note']").val();
      var categorie = $("#test-create-categorie").find(":selected").val();
      
      var url = $form.attr("action");
    
      $("select, input, textarea").attr("disabled",true);
      $("button").attr("disabled","disabled");
      $("p.errors-form").removeClass('success').removeClass('error').text("");
    
      $.ajax({
          type: "post",
          url: url,
          async: true,
          dataType: 'json',
          data: {
            "titre": titre, 
            "description": description, 
            "temps": temps, 
            "categorie": categorie,
            "tentatives": tentatives, 
            "questions": getQuestions, 
            "arrondi_note": arrondi_note, 
          },
          success: function (data) {
            $("select, input, textarea").attr("disabled",false);
            $("button").attr("disabled", false);
              if(data.response == "success") {
                $("p.errors-form").addClass('success').text("Question ajoutée.");
                modal("Question ajoutée", " Votre question a été enregistrée avec succès. Vous pouvez en créer une autre en appuyant sur le bouton 'Créer à nouveau', où visualiser la liste des questions en cliquant sur Terminé.", "Créer à nouveau", "quest_blank()", "Terminé", "questions_list()");
              }
              if(data.response == "err_saisie") {
                $("p.errors-form").addClass('error').text("Veuillez vérifier vos saisies.");
              }
          },
          error: function (data) {
            $("select, input, textarea").attr("disabled",false);
            $("button").attr("disabled", false);
            $("p.errors-form").addClass('error').text("Une erreur est survenue");
          },
      });
  });

  /////////////////////////////////////////// user send test


  $("#test-finish").submit(function(event){

    event.preventDefault();
    getReponses = buildReponses();
  
      var $form = $(this);
    
      var testId = $form.find("input[name='testid']").val();
      
      var url = $form.attr("action");
    
      $("select, input, textarea").attr("disabled",true);
      $("button").attr("disabled","disabled");
      $("p.errors-form").removeClass('success').removeClass('error').text("");
    
      $.ajax({
          type: "post",
          url: url,
          async: true,
          dataType: 'json',
          data: {
            "testid": testId, 
            "reponses": getReponses, 
          },
          success: function (data) {
            $("select, input, textarea").attr("disabled",false);
            $("button").attr("disabled", false);
              if(data.response == "success") {
                $("p.errors-form").addClass('success').text("Test terminé.");
                modal("Test terminé", " Vos réponses ont été enregistrées avec succès.", "Retour à l'accueil", "test_do_blank()", "Voir mes résultats", "tests_user_result("+ testId +")"); "#checkbox"+index
              }
              if(data.response == "err_notavail") {
                $("p.errors-form").addClass('error').text("Le test n'est plus disponible.");
              }
              if(data.response == "err_notpublished") {
                $("p.errors-form").addClass('error').text("Le test n'est pas publié.");
              }
              if(data.response == "err_timeout") {
                $("p.errors-form").addClass('error').text("Le temps est écoulé.");
              }
              if(data.response == "err_alreadysubmit") {
                $("p.errors-form").addClass('error').text("Une tentative a déjà été envoyée.");
              }
          },
          error: function (data) {
            $("select, input, textarea").attr("disabled",false);
            $("button").attr("disabled", false);
            $("p.errors-form").addClass('error').text("Une erreur est survenue");
          },
      });
  });

  ///////////////////////////////////////////

  $("#tests-index").click(function(event){
    event.preventDefault();
    updateAjax('?action=tests-index');
  });

  $("#questions-index").click(function(event){
    event.preventDefault();
    updateAjax('?action=questions-index');
  });
  
  $("#categories-index").click(function(event){
    event.preventDefault();
    updateAjax('?action=categories-index');
  });

});



  /////////////////////////////////////////// create question

// send request

  function quest_blank() {
    $(':input','#categorie-send')
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .prop('checked', false)
    .prop('selected', false);
    dismissmodal();
    $(".propositions").empty();
    addProposition();
  }

  function questions_list() {
    dismissmodal();
  }

// construire l'array des reponses aux questions create

function buildPropositions() {
  amount = $(".propositions .reponse").length;


// [0 => 'blabla', ...] 
  propositions = [];
  
// [0,2,...]
  reponsesId = [];

// result
  responses = [];
  
  for (let index = 0; index < amount; index++) {
      currentElem = $(".propositions .reponse").get(index);
      reponse  = $(currentElem).find(".has-float-label input").val();
      checkbox = $(currentElem).find("#checkbox"+index).is(":checked");

      if(reponse != '') {
        propositions.push(reponse);
        if(checkbox == true) {
          reponsesId.push(index);
        }
      }
  }
  responses.push(propositions);
  responses.push(reponsesId);
  return(responses);
}

// ajouter ou supprimer des reponses

  questionsCreatePropositions = 1;

function addProposition() {
  $("button.small").remove();
  if(questionsCreatePropositions < 10) {
    questionsCreatePropositions = questionsCreatePropositions+1;
    id = questionsCreatePropositions -1;
    $(".propositions").append("<div class='reponse' id='reponse"+ id +"'><label class='has-float-label'><input placeholder=' ' type='text' name='reponse"+ id + "'><span class='label'>Réponse "+ questionsCreatePropositions + " *</span><div class='helper'>Doit être de 2 caractères minimum</div><div class='error'>Erreur: Doit être de 2 caractères minimum</div></label><div class='check'><input type='checkbox' id='checkbox"+ id + "'><div><label for='checkbox"+ id + "'>Définir comme réponse</label></div></div><div class='reponse-del' onclick='deleteProposition(" + id + ")'><span class='material-icons'>delete_forever</span></div></div>");
  }

  if(questionsCreatePropositions < 10) {
    $(".propositions").append("<button class='small' onclick='addProposition()' type='button'>Ajouter une proposition</button>");  
  }
}
//  <button class='small'>Ajouter une proposition</button>
  
function deleteProposition(id) {
  $(".propositions #reponse"+id).remove();
  recalcPropositions();
}

// re calculer les identifiants de chaque input

function recalcPropositions() {
  $("button.small").remove();
  amount = $(".propositions .reponse").length;
  
  for (let index = 0; index < amount; index++) {
    currentElem = $(".propositions .reponse").get(index);
    newIndex = index+1;

    $(currentElem).find(".has-float-label span.label").text("Réponse " + newIndex + " *");

    $(currentElem).find(".reponse-del").attr("onclick", "deleteProposition("+index+")");
    $(currentElem).attr("id", "reponse" + index);
  }

  questionsCreatePropositions = amount;

  if(questionsCreatePropositions < 10) {
    $(".propositions").append("<button class='small' onclick='addProposition()' type='button'>Ajouter une proposition</button>");  
  }
}

function categ_blank() {
  $(':input','#categorie-send')
  .not(':button, :submit, :reset, :hidden')
  .val('')
  .prop('checked', false)
  .prop('selected', false);
  dismissmodal();
}

/////////////////////////////////////// submit tests user

//"test_do_blank()", "Voir mes résultats", "tests_user_result()");

function test_do_blank() {
  window.location.href = "index.php";
}

function tests_user_result(testId) {
  window.location.href = "index.php?action=resultattest&id=" + testId;
}

// construire l'array des reponses aux questions create

function buildReponses() {

  amount = $(".form-block .question").length;

// for each. data = [0 {"questionId": "id", ...}, 1 {}...]

  data = []
  
  for (let index = 0; index < amount; index++) {
    currentElem = $(".form-block .question").get(index);
    reponse  = $(currentElem).find(":selected").val();
    questionId  = $(currentElem).attr("id");
    questionType  = $(currentElem).attr("type");

    data.push({"questionId":questionId,"reponses":[]});
    
    if(questionType == 0) {
      data[index]["reponses"].push($(currentElem).find("input").val());
    }
    if(questionType == 1) {
      data[index]["reponses"].push($(currentElem).find(":selected").val());
    }
    if(questionType == 2) {
      $(currentElem).find('input[type=checkbox]:checked').each(function() {
        data[index]["reponses"].push($(this).attr('value'));
      });
    }

  }
  return(data);
}

/////////////////////////////////////// questions

// ajouter ou supprimer des reponses

// construire l'array des reponses aux questions create

function buildQuestions() {

  amount = $(".propositions .reponse").length;


// [0 => 'blabla', ...] 
  question = [];
  
// [0,2,...]
  reponsesId = [];

// premiere reponse

  currentElem = $(".reponses-cache").get();
  reponse  = $(currentElem).find(":selected").val();
  question.push(reponse);

// le reste
  
  for (let index = 0; index < amount; index++) {
    currentElem = $(".propositions .reponse").get(index);
    reponse  = $(currentElem).find(":selected").val();
    
    if(reponse != "" && reponse != null) { question.push(reponse); }
  }
  return(question);
}

questionsCreatePropositions = 1;

function addQuestion() {
  $("button.small").remove();
  if(questionsCreatePropositions < 30) {
    questionsCreatePropositions = questionsCreatePropositions+1;
    id = questionsCreatePropositions -1;
    $(".reponses-cache").clone().appendTo(".propositions");
    $(".propositions .reponses-cache").attr("id", "reponse-" + id);
    $(".propositions .reponses-cache").attr("class", "reponse");
    $(".propositions .reponse select#test-create-questions").attr("id", "test-create-questions-" + id);
    $("#reponse-" + id).append("<div class='reponse-del' onclick='deleteQuestion(" + id + ")'><span class='material-icons'>delete_forever</span></div>");
    $("#reponse-" + id).find(".question-indice").text(id+1 + ") ");
//    $(".propositions").append("<div class='reponse' id='reponse"+ id +"'><label class='has-float-label'><input placeholder=' ' type='text' name='reponse"+ id + "'><span class='label'>Réponse "+ questionsCreatePropositions + " *</span><div class='helper'>Doit être de 2 caractères minimum</div><div class='error'>Erreur: Doit être de 2 caractères minimum</div></label></div></div><div class='reponse-del' onclick='deleteQuestion(" + id + ")'><span class='material-icons'>delete_forever</span></div></div>");
  }

  if(questionsCreatePropositions < 30) {
    $(".propositions").append("<button class='small' onclick='addQuestion()' type='button'>Ajouter une question</button>");  
  }
}
//  <button class='small'>Ajouter une proposition</button>
  
function deleteQuestion(id) {
  $(".propositions #reponse-"+id).remove();
  recalcQuestion();
}

// re calculer les identifiants de chaque input

function recalcQuestion() {
  $("button.small").remove();
  amount = $(".propositions .reponse").length;
  
  for (let index = 0; index < amount; index++) {
    currentElem = $(".propositions .reponse").get(index);
    newIndex = index+1;


    $(currentElem).find(".reponse-del").attr("onclick", "deleteQuestion("+index+")");
    $(currentElem).attr("id", "reponse-" + index);
    console.log($(currentElem).find(".question-indice"));
    $(currentElem).find(".question-indice").text(index+1 + ") ");
  }

  questionsCreatePropositions = amount;

  if(questionsCreatePropositions < 30) {
    $(".propositions").append("<button class='small' onclick='addQuestion()' type='button'>Ajouter une question</button>");  
  }
}



function updateAjax(url) {
	history.pushState({ goBack: true }, '', url);
	loadPage(url);
}


// back button
history.replaceState({ goBack: true }, '');

$(window).on("popstate", function(e) {
	if(!e.originalEvent.state.goBack) { return; }
	loadPage(window.location.href);
});
function loadPage(url) {
	// do the ajax call and inject new url
	console.log('loading '+url);

  $.ajax({
    type: "GET",
    url: url,
    data: { },
    success: function(data){
      $('body').html(data);
    }
  });
}

function modal(title, text, actiontext, actionurl, actiontext2, actionurl2) {
  $("body").append("<div class='modal-overlay'><div class='modal' id='myModal-2'><div class='modal-dialog'><div class='modal-header'><h4 class='modal-title' id='myModalLabel-2'>" + title + "</h4></div><div class='modal-content'><div class='modal-body'><p>" + text + "</p></div><div class='modal-footer'><button type='button' onclick=" + actionurl + " class='btn btn-dialog' data-dismiss='modal'>" + actiontext + "</button><button type='button' onclick=" + actionurl2 + " class='btn btn-dialog' data-dismiss='modal'>" + actiontext2 + "</button></div></div></div></div></div>");
}

function dismissmodal() {
  $(".modal-overlay").hide();
}