import React, { Fragment } from "react";

import Filter from "./Filter";
import MainReport from "./MainReport";
import GruppaReport from "./GruppaReport";
import ExtraReport from "./ExtraReport";

class Main extends React.Component {
  constructor() {
    super();

    this.state = {
      isStandartMode: true,
      filter: {
        teacher: "",
        program: "",
        unit: "",
        gruppa: "",
        period: ""
      },
      reportData: [],
      gruppaReportData: [],
      gruppaReportFilter: {},
      extraReportData: [],
      testReportData: []
    };
  }

  getFilter = filterObj => {
    let res = "";
    if (filterObj) {
      for (const [key, value] of Object.entries(filterObj)) {
        res += `${value ? value : "none"}/`;
      }
    }
    return res.slice(0, -1);
  };

  filterChange = e => {
    e.preventDefault();
    const key = e.target.getAttribute("id");
    const { filter } = this.state;
    filter[key] = e.target.value;
    this.setState({ filter });
  };

  getReportData = (api, callback) => {
    fetch(api)
      .then(response => {
        return response.json();
      })
      .then(data => {
        callback(data);
      });
  };

  reportChange = reportData => {
    this.setState({ reportData });
  };

  extraReportChange = extraReportData => {
    this.setState({ extraReportData });
  };

  testReportChange = testReportData => {
    this.setState({ testReportData });
  };

  gruppaReportDataChange = (gruppaReportData, gruppaReportFilter) => {
    this.setState({ gruppaReportData, gruppaReportFilter });
  };

  modeChange = evt => {
    this.setState({ isStandartMode: !evt.target.checked });
  };

  componentDidUpdate() {
    this.getFilter();
  }

  selectRow(evt) {
    let selectedRow = document.querySelector(".rep-table .rep-selected");
    if (selectedRow) {
      selectedRow.classList.remove("rep-selected");
    }
    selectedRow = evt.target.parentNode;
    selectedRow.classList.add("rep-selected");
  }

  render() {
    const filter = this.getFilter(this.state.filter);
    const gruppaReportFilter = this.getFilter(this.state.gruppaReportFilter);
    return (
      <div className="mx-4">
        <h3 className="text-center mb-1">Анализ тестирований</h3>
        <Filter
          filter={this.state.filter}
          filterChange={this.filterChange}
          mode={this.state.isStandartMode}
          modeChange={this.modeChange}
        />
        {this.state.isStandartMode ? (
          <Fragment>
            <MainReport
              reportApi={`/report/${filter}`}
              reportData={this.state.reportData}
              reportChange={this.reportChange}
              getReportData={this.getReportData}
              gruppaReportApi={`/gruppa-report/${gruppaReportFilter}`}
              gruppaReportDataChange={this.gruppaReportDataChange}
              selectRow={this.selectRow}
            />
            <GruppaReport
              data={this.state.gruppaReportData}
              visible={this.state.reportData.length > 0}
              filter={this.state.gruppaReportFilter}
            />
          </Fragment>
        ) : (
          <ExtraReport
            reportApi={`/extra-report/${filter}`}
            reportData={this.state.extraReportData}
            reportChange={this.extraReportChange}
            getReportData={this.getReportData}
            testReportData={this.state.testReportData}
            testReportChange={this.testReportChange}
            selectRow={this.selectRow}
          />
        )}
      </div>
    );
  }
}

export default Main;
