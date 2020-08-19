import React, { Fragment } from 'react';

import TestReport from './TestReport';
import './ExtraReport.css';

class ExtraReport extends React.Component {
  constructor(props) {
    super(props);
    const expTable = null;
  }

  showTestDetails = evt => {
    this.props.selectRow(evt);
    const api = `/answers/${evt.target.parentNode.dataset.id}`;
    this.props.getReportData(api, this.props.testReportChange);
  };

  componentDidMount() {
    this.props.getReportData(this.props.reportApi, this.props.reportChange);
  }

  componentDidUpdate(prevProps) {
    if (prevProps.reportApi !== this.props.reportApi) {
      this.props.getReportData(this.props.reportApi, this.props.reportChange);
    }
  }
  render() {
    return (
      <Fragment>
        <div className="container mx-auto extra-div">
          <div className="d-flex justify-content-between align-items-center">
            <h4 id="extra-header" className="text-center mt-3">
              Развернутый отчет:{' '}
            </h4>
          </div>
          <table
            id="extra-report-table"
            className="table table-striped table-hover table-light rep-table"
          >
            <thead>
              <tr>
                <th>№</th>
                <th>ФИО тестируемого</th>
                <th>Телефон</th>
                <th>Преподаватель</th>
                <th>Программа</th>
                <th>Юнит</th>
                <th>Группа</th>
                <th>Оценка</th>
                <th>Дата</th>
                <th>Затраченное время</th>
              </tr>
            </thead>
            <tbody>
              {this.props.reportData.map((row, i) => {
                return (
                  <tr
                    key={`rep${i}`}
                    data-id={row['qr_id']}
                    onClick={this.showTestDetails}
                    className="selectable"
                  >
                    <td>{i + 1}</td>
                    <td>{row['stud_name']}</td>
                    <td>{row['phone']}</td>
                    <td>{row['teacher']}</td>
                    <td>{row['program']}</td>
                    <td>{row['unit']}</td>
                    <td>{row['gruppa']}</td>
                    <td>{row['user_score']}</td>
                    <td>{row['finished_at']}</td>
                    <td>{row['quiz_time']}</td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
        <TestReport reportData={this.props.testReportData} />
      </Fragment>
    );
  }
}

export default ExtraReport;
