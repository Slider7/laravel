import React, { Fragment } from "react";

import "./ExtraReport.css";

class TestReport extends React.Component {
  render() {
    return (
      <div className={`${this.props.reportData[0] ? "" : "d-none"} mx-5`}>
        <h4 className="text-center mt-3">Данные тестирования: </h4>
        <table
          id="test-report-table"
          className="table table-striped table-hover rep-table"
        >
          <thead>
            <tr>
              <th>№</th>
              <th>Quiz-код</th>
              <th>Текст вопроса</th>
              <th className="d-none">Ответ</th>
              <th>Набрано баллов</th>
              <th>Пороговый балл</th>
            </tr>
          </thead>
          <tbody>
            {this.props.reportData.map((row, i) => {
              const ap = row["award_points"],
                mp = row["maxpoint"];
              return (
                <tr key={`test-rep${i}`}>
                  <td>{i + 1}</td>
                  <td>{row["quiz_code"]}</td>
                  <td>{row["q_text"]}</td>
                  <td className="d-none">{row["user_resp"]}</td>
                  <td className={ap >= mp ? "ok" : "fail"}>{ap}</td>
                  <td>{mp}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
    );
  }
}

export default TestReport;
