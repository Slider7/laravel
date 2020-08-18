function exportTableToExcel(tableID, filename = "") {
  let uri = "data:application/vnd.ms-excel;base64,",
    template =
      '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
    base64 = function(s) {
      return window.btoa(unescape(encodeURIComponent(s)));
    },
    format = function(s, c) {
      return s.replace(/{(\w+)}/g, function(m, p) {
        return c[p];
      });
    };
  return function() {
    let table = document.querySelector(`#${tableID}`);
    let tStr = table.innerHTML;
    let ctx = { worksheet: "Отчет", table: tStr };
    let link = document.createElement("a");
    link.download = `${filename}.xlsx`;
    link.href = uri + base64(format(template, ctx));
    link.click();
  };
}

const getReportData = (api, callback) => {
  fetch(api)
    .then(response => {
      return response.json();
    })
    .then(data => {
      callback(data);
    });
};

const selectRow = evt => {
  let selectedRow = document.querySelector(".rep-table .rep-selected");
  if (selectedRow) {
    selectedRow.classList.remove("rep-selected");
  }
  selectedRow = evt.target.parentNode;
  selectedRow.classList.add("rep-selected");
};

export { exportTableToExcel, getReportData, selectRow };
