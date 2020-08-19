import React, { Fragment } from 'react';
import TableExport from 'tableexport';

import Filter from './Filter';
import MainReport from './MainReport';
import GruppaReport from './GruppaReport';
import ExtraReport from './ExtraReport';
import { getReportData, selectRow } from '../utils';

class Main extends React.Component {
  constructor() {
    super();

    this.state = {
      isStandartMode: true,
      filter: {
        teacher: '',
        program: '',
        unit: '',
        gruppa: '',
        period: ''
      },
      reportData: [],
      gruppaReportData: [],
      gruppaReportFilter: {},
      extraReportData: [],
      testReportData: []
    };
  }

  getFilter = filterObj => {
    let res = '';
    if (filterObj) {
      for (const [key, value] of Object.entries(filterObj)) {
        res += `${value ? value : 'none'}/`;
      }
    }
    return res.slice(0, -1);
  };

  filterChange = e => {
    e.preventDefault();
    const key = e.target.getAttribute('id');
    const { filter } = this.state;
    filter[key] = e.target.value;
    this.setState({ filter });
  };

  reportChange = reportData => {
    this.setState({ reportData });
  };

  extraReportChange = extraReportData => {
    this.setState({ extraReportData }, this.updateExport);
  };

  updateExport = () => {
    const table = document.querySelector('#extra-report-table');
    const xls = document.querySelector('.xlsx'),
      txt = document.querySelector('.txt');
    if (xls) {
      xls.parentNode.removeChild(xls);
    }
    if (txt) {
      txt.parentNode.removeChild(txt);
    }
    TableExport(table, {
      headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
      formats: ['xlsx', 'txt'],
      filename: document.querySelector('#extra-header').innerHTML
    });
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
              getReportData={getReportData}
              gruppaReportApi={`/gruppa-report/${gruppaReportFilter}`}
              gruppaReportDataChange={this.gruppaReportDataChange}
              selectRow={selectRow}
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
            getReportData={getReportData}
            testReportData={this.state.testReportData}
            testReportChange={this.testReportChange}
            selectRow={selectRow}
          />
        )}
      </div>
    );
  }
}

export default Main;
