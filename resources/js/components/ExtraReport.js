import React, { Fragment } from "react";

import "./ExtraReport.css";

class ExtraReport extends React.Component {
  componentDidMount() {
    this.props.getReportData(this.props.reportApi, this.props.reportChange);
  }

  componentDidUpdate(prevProps) {
    if (prevProps.reportApi !== this.props.reportApi) {
      this.props.getReportData(this.props.reportApi, this.props.reportChange);
    }
  }
  render() {
    console.log(this.props.reportData);
    return (
      <div className="container mx-auto">
        <h4 className="text-center mt-3">Развернутый отчет: </h4>
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
              <th className="d-none">qr_id</th>
            </tr>
          </thead>
          <tbody>
            {this.props.reportData.map((row, i) => {
              return (
                <tr key={`rep${i}`} onClick={this.gruppaReportChange}>
                  <td>{i + 1}</td>
                  <td>{row["stud_name"]}</td>
                  <td>{row["phone"]}</td>
                  <td>{row["teacher"]}</td>
                  <td>{row["program"]}</td>
                  <td>{row["unit"]}</td>
                  <td>{row["gruppa"]}</td>
                  <td>{row["user_score"]}</td>
                  <td>{row["finished_at"]}</td>
                  <td>{row["quiz_time"]}</td>
                  <td className="d-none">{row["qr_id"]}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
    );
  }
}

export default ExtraReport;
