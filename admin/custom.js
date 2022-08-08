$("#editModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  $.ajax({
    type: "POST",
    url: "actions.php",
    data: {
      getApp: "check",
      id: rec,
    },
    cache: false,
    success: function (data) {
      var obj = JSON.parse(data);
      var modal = $(this);
      $("#id").val(obj["id"]);
      $("#vname").val(obj["name"]);
      $("#email").val(obj["email"]);
      $("#contactno").val(obj["contact"]);
      $("#address").val(obj["address"]);
      $("#pfirst").val(obj["pfirst"]);
      $("#plast").val(obj["plast"]);
      $("#rela").val(obj["relation"]);
      $("#pdate").val(obj["pdate"]);
      $("#selected").val(obj["status"]);
      $("#selected").html(obj["status"]);
      console.log($("#relation").val());
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
$("#editFamModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  $.ajax({
    type: "POST",
    url: "actions.php",
    data: {
      getF: "check",
      id: rec
    },
    cache: false,
    success: function (data) {
      var obj = JSON.parse(data);
      $("#famid").val(obj[0]);
      $("#famname").val(obj[1]);
      $("#famage").val(obj[2]);
      $("#famsex").val(obj[3]).html(obj[3]);
      $("#famrela").val(obj[4]);
      $("#occ").val(obj[5]);
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
$("#editPrisonModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  $.ajax({
    type: "POST",
    url: "actions.php",
    data: {
      getP: "check",
      prison_id: rec,
    },
    cache: false,
    success: function (data3) {
      $("#pStatus").empty();
      var obj = JSON.parse(data3);
      $("#editPname").val(obj["data"][0]);
      var htl = "Edit " + obj["data"][0];
      $("#editPrisonModalLabel").html(htl);
      $("#eid").val(rec);
      if (obj["data"][1] == "1") {
        $("#pStatus").append(
          $("<option> </option>").val(obj["data"][1]).html("Active").hide()
        );
        $("#pStatus").append($("<option> </option>").val("1").html("Active"));
        $("#pStatus").append($("<option> </option>").val("0").html("Inactive"));
      } else if (obj["data"][1] == "0") {
        $("#pStatus").append(
          $("<option> </option>").val(obj["data"][1]).html("Inactive").hide()
        );
        $("#pStatus").append($("<option> </option>").val("1").html("Active"));
        $("#pStatus").append($("<option> </option>").val("0").html("Inactive"));
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
$("#editActionModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  $.ajax({
    type: "POST",
    url: "actions.php",
    data: {
      getA: "check",
      prison_id: rec,
    },
    cache: false,
    success: function (data3) {
      $("#pStatus").empty();
      var obj = JSON.parse(data3);
      $("#action_name").val(obj["data"][0]);
      var htl = "Edit " + obj["data"][0];
      $("#editActionModalLabel").html(htl);
      $("#action_id").val(rec);
      if (obj["data"][1] == "1") {
        $("#pStatus").append(
          $("<option> </option>").val(obj["data"][1]).html("Active").hide()
        );
        $("#pStatus").append($("<option> </option>").val("1").html("Active"));
        $("#pStatus").append($("<option> </option>").val("0").html("Inactive"));
      } else if (obj["data"][1] == "0") {
        $("#pStatus").append(
          $("<option> </option>").val(obj["data"][1]).html("Inactive").hide()
        );
        $("#pStatus").append($("<option> </option>").val("1").html("Active"));
        $("#pStatus").append($("<option> </option>").val("0").html("Inactive"));
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
$("#editCellModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var recs = button.data("whatever");
  $.ajax({
    type: "POST",
    url: "actions.php",
    data: {
      getC: "check",
      prison_id: recs,
    },
    cache: false,
    success: function (data3) {
      $("#pStatus").empty();
      $("#ep-cell").empty();
      var obj = JSON.parse(data3);
      $("#ecellName").val(obj["data"][1]);
      var htl = "Edit " + obj["data"][1];
      $("#editCellModalLabel").html(htl);
      $("#ecellid").val(recs);
      if (obj["data"][2] == "1") {
        $("#pStatus").append(
          $("<option> </option>").val(obj["data"][2]).html("Active").hide()
        );
        $("#pStatus").append($("<option> </option>").val("1").html("Active"));
        $("#pStatus").append($("<option> </option>").val("0").html("Inactive"));
      } else if (obj["data"][2] == "0") {
        $("#pStatus").append(
          $("<option> </option>").val(obj["data"][2]).html("Inactive").hide()
        );
        $("#pStatus").append($("<option> </option>").val("1").html("Active"));
        $("#pStatus").append($("<option> </option>").val("0").html("Inactive"));
      }
      $("#ep-cell").append(
        $("<option> </option>").val(obj["data"][3]).html(obj["data"][0]).hide()
      );
      $.ajax({
        type: "POST",
        url: "actions.php",
        data: { getPrison: "get" },
        cache: false,
        success: function (data1) {
          var obj = JSON.parse(data1);
          var ctr = obj["data"].length;
          for (let i = 0; i < ctr; i++) {
            var pname = obj["data"][i][2];
            var id = obj["data"][i][5];
            $("#ep-cell").append($("<option> </option>").val(id).html(pname));
            $("#ep-cell").selectpicker("refresh");
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr);
          console.error(error);
        },
      });
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
$("#editRecordModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  var pid = $("#hist-div").data("val");
  $.ajax({
    type: "POST",
    url: "actions.php",
    data: {
      getE: "check",
      prisoner_id: rec,
      pid: pid,
    },
    cache: false,
    success: function (data2) {
      $("#b-cell").empty();
      var obj = JSON.parse(data2);
      $("#edate").val(obj["date_created"]);
      $("#remarks").val(obj["remarks"]);
      $("#b-cell").append(
        $("<option> </option>").val(obj["action_id"]).html(obj["action"]).hide()
      );
      $("#e_id").val(rec);
      $("#pri-id").val(pid);
      $.ajax({
        type: "POST",
        url: "actions.php",
        data: {
          getVal: "get",
        },
        cache: false,
        success: function (data3) {
          var obj1 = JSON.parse(data3);
          $("#ref").val("view");
          var ctr = obj1.length;
          for (let i = 0; i < ctr; i++) {
            var aname = obj1[i]["action"];
            var id = obj1[i]["action_id"];
            $("#b-cell").append($("<option> </option>").val(id).html(aname));
            $("#b-cell").selectpicker("refresh");
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr);
        },
      });
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
$("#deleteModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  var pid = button.data("serv");
  var typeOf = $("#type").val();
  $("#delete_id").val(rec);
  $("#typeOf").val(typeOf);
  $("#pri_id").val(pid);
});
$("#deleteFamModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var rec = button.data("whatever");
  $("#del_id").val(rec);
});
$("#redirectOfficer").click(function () {
  window.location.href = "add-officer-form.php";
});
$("#redirectPrisoner").click(function () {
  window.location.href = "add-prisoner-form.php";
});
$("#redirectAdmin").click(function () {
  window.location.href = "add-admin.php";
});
$("#cancel").click(function () {
  var url = $("#cancel").data("whatever");
  window.location.href = url + ".php";
});
var ctr = 0;
$("#remove-button").hide();
$("#add-button").click(function () {
  ctr = ctr + 1;
  var inner =
    '<div class="mem-' +
    ctr +
    '"><h5 class="my-3">Add Family Member</h5><div class=" border border-secondary p-5"><div class="row"><div class="form-group col"><label for="ename">Name <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famname" name="famname[]" placeholder="Name" required></div></div><div class="row"><div class="form-group col"><label for="ename">Age <span class="text-danger">(Required)</span></label><input type="number" class="form-control" id="famage" name="famage[]" placeholder="Age" required></div></div><div class="row"><div class="form-group col"><label for="sex">Sex assigned at Birth<span class="text-danger">(Required)</span></label><select type="text" class="form-control" id="famsex" name="famsex[]" placeholder="Sex" required><option value="Male" selected>Male</option><option value="Female">Female</option></select></div></div><div class="row"><div class="form-group col"><label for="erela">Relation <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famrela" name="famrela[]" placeholder="Relation" required></div></div><div class="row"><div class="form-group col"><label for="erela">Occupation / Source of Income <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="occ" name="occ[]" placeholder="Occupation / Source of Income" required></div><div class="form-group d-flex justify-content-end"><button type="button" class="btn btn-outline-danger remove-button" id="remove-button" data-id="' +
    ctr +
    '" data-whatever="no">Remove</button></div></div></div></div>';
  $("#family-body").append(inner).hide().show("slow");
  $("#fam-ctr").val(ctr);
});
$("body").on("click", "#remove-button", function () {
  var id = $(this).data("id");
  var elem = ".mem-" + id;
  $(elem).hide("slow", function () {
    $(elem).remove();
  });
  ctr = ctr - 1;
  $("#fam-ctr").val(ctr);
});
