import React, { Fragment } from "react";

import "./MainReport.css";

class MainReport extends React.Component {
  gruppaReportChange = evt => {
    let selectedRow = document.querySelector(".rep-table .rep-selected");
    if (selectedRow) {
      selectedRow.classList.remove(".rep-selected");
    }
    selectedRow = evt.target.parentNode;
    selectedRow.classList.add("rep-selected");

    let gruppaFilter = "";

    for (let i = 1; i <= 4; i++) {
      gruppaFilter += `${selectedRow.cells[i].textContent}/`;
    }

    fetch(`/gruppa-report/${gruppaFilter}`)
      .then(response => {
        return response.json();
      })
      .then(data => {
        this.props.gruppaReportDataChange(data, gruppaFilter);
      });
  };

  componentDidMount() {
    this.props.getReportData(this.props.reportApi, this.props.reportChange);
  }

  componentDidUpdate(prevProps, prevState) {
    if (prevProps.reportApi !== this.props.reportApi) {
      this.props.getReportData(this.props.reportApi, this.props.reportChange);
    }
  }

  render() {
    let period = "";
    const sel = document.querySelector("#period");
    if (sel && sel.selectedIndex) period = sel.options[sel.selectedIndex].text;
    return (
      <div className="container mx-auto">
        <h4 className="text-center mt-3">Отчет по тестированиям: {period}</h4>
        <table
          id="quiz-table"
          className="table table-striped table-hover table-light rep-table"
        >
          <thead>
            <tr>
              <th>№</th>
              <th>Преподаватель</th>
              <th>Программа</th>
              <th>Юнит</th>
              <th>Группа</th>
              <th>Протестировано</th>
              <th>%</th>
            </tr>
          </thead>
          <tbody>
            {this.props.reportData.map((row, i) => {
              return (
                <tr key={`rep${i}`} onClick={this.gruppaReportChange}>
                  <td>{i + 1}</td>
                  <td>{row["teacher"]}</td>
                  <td>{row["program"]}</td>
                  <td>{row["unit"]}</td>
                  <td>{row["gruppa"]}</td>
                  <td>{row["cnt"]}</td>
                  <td>{row["avg_prc"]}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
    );
  }
}

export default MainReport;
