let MyDateField = function (config) {
  jsGrid.Field.call(this, config);
};

MyDateField.prototype = new jsGrid.Field({
  sorter: function (date1, date2) {
    // console.log('on sorting fild ' + date1 + ' ' + date2);
    return new Date(date1) - new Date(date2);
  },

  itemTemplate: function (value) {
    // console.log('on init item template');
    if (value === null) {
      return "";
    } else {
      return moment(value).format("DD-MM-YYYY");
    }
  },

  insertTemplate: function (value) {
    // console.log('on init insert template ' + moment());
    this._insertPicker = $("<input>").datetimepicker({
      locale: "id",
      format: "DD-MM-YYYY",
      defaultDate: moment(),
      widgetPositioning: {
        horizontal: "left",
        vertical: "bottom",
      },
    });
    // console.log('insert template created')
    this._insertPicker.data("DateTimePicker").date(moment());
    return this._insertPicker;
  },

  editTemplate: function (value) {
    // console.log('on init edit template');
    this._editPicker = $("<input>").datetimepicker({
      locale: "id",
      format: "DD-MM-YYYY",
      widgetPositioning: {
        horizontal: "left",
        vertical: "bottom",
      },
    });

    if (value !== null) {
      this._editPicker.data("DateTimePicker").defaultDate(moment(value));
      this._editPicker.data("DateTimePicker").date(moment(value));
    }
    return this._editPicker;
  },

  insertValue: function () {
    // console.log('on get insert value');
    let insertDate = this._insertPicker.data("DateTimePicker").date();
    if (typeof insertDate !== "undefined" && insertDate !== null) {
      return insertDate.format("YYYY-MM-DD");
    } else {
      return null;
    }
  },

  editValue: function () {
    // console.log('on get edit value');
    let editValue = this._editPicker.data("DateTimePicker").date();
    if (typeof editValue !== "undefined" && editValue !== null) {
      return editValue.format("YYYY-MM-DD");
    } else {
      return null;
    }
  },
});

jsGrid.fields.date = MyDateField;

let MyYearField = function (config) {
  jsGrid.Field.call(this, config);
};

MyYearField.prototype = new jsGrid.Field({
  sorter: function (date1, date2) {
    return date2 - date1;
  },

  itemTemplate: function (value) {
    // console.log('on init item template');
    if (value === null) {
      return "";
    } else {
      return moment(value).format("YYYY");
    }
  },

  insertTemplate: function (value) {
    // console.log('on init insert template ' + moment());
    this._insertPicker = $("<input>").datetimepicker({
      locale: "id",
      format: "YYYY",
      defaultDate: moment(),
      widgetPositioning: {
        horizontal: "left",
        vertical: "bottom",
      },
    });
    // console.log('insert template created')
    this._insertPicker.data("DateTimePicker").date(moment());
    return this._insertPicker;
  },

  editTemplate: function (value) {
    // console.log('on init edit template');
    this._editPicker = $("<input>").datetimepicker({
      locale: "id",
      format: "YYYY",
      widgetPositioning: {
        horizontal: "left",
        vertical: "bottom",
      },
    });

    if (value !== null) {
      this._editPicker.data("DateTimePicker").defaultDate(moment(value));
      this._editPicker.data("DateTimePicker").date(moment(value));
    }
    return this._editPicker;
  },

  insertValue: function () {
    // console.log('on get insert value');
    let insertDate = this._insertPicker.data("DateTimePicker").date();
    if (typeof insertDate !== "undefined" && insertDate !== null) {
      return insertDate.format("YYYY");
    } else {
      return null;
    }
  },

  editValue: function () {
    // console.log('on get edit value');
    let editValue = this._editPicker.data("DateTimePicker").date();
    if (typeof editValue !== "undefined" && editValue !== null) {
      return editValue.format("YYYY");
    } else {
      return null;
    }
  },
});

jsGrid.fields.year = MyYearField;
