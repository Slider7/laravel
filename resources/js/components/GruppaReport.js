import React, { Fragment } from "react";

import "./MainReport.css";

class GruppaReport extends React.Component {
  formatDataTable = data => {
    const ids = [...new Set(data.map(a => a.qr_id))];
    if (ids.length) {
    }
    let res = [];
    ids.forEach(id => {
      let row = [];
      data.forEach(d => {
        if (d.qr_id === id) {
          if (row.indexOf(d.stud_name) < 0) row.push(d.stud_name);
          if (row.indexOf(d.pass_score) < 0) row.push(d.pass_score);
          if (row.indexOf(d.user_score) < 0) row.push(d.user_score);
          if (row.indexOf(d.stud_percent) < 0) row.push(d.stud_percent);
          row.push({
            qNum: d.qtext,
            points: d.points,
            res: d.result
          });
        }
      });
      row.push(row[1] <= row[2] ? "OK" : "fail");
      res.push(row);
    });
    return res;
  };

  render() {
    const repData = this.formatDataTable(this.props.data);
    if (repData[0]) {
      const params = this.props.filter.split("/");

      return (
        <div className={this.props.visible ? "" : "d-none"}>
          <h4 className="text-center mt-3">
            Отчет тестирования группы{" "}
            {`${params[3]}, программа ${params[1]}, unit ${params[2]}, преподаватель ${params[0]}: `}
          </h4>
          <table id="quiz-table" className="table table-striped gruppa-table">
            <thead>
              <tr>
                <th>№</th>
                <th>ФИО тестируемого</th>
                <th>Проходной балл</th>
                <th>Получено баллов</th>
                <th>Результат(%)</th>
                {repData[0].slice(4).map((col, i) => (
                  <th key={i}>{col.qNum ? col.qNum : "Статус"}</th>
                ))}
              </tr>
            </thead>
            <tbody>
              {repData.map((row, i) => {
                return (
                  <tr key={`gr-${i}`}>
                    <td>{i + 1}</td>
                    {row.map((col, j) => {
                      return (
                        <td
                          key={`col-${i}${j}`}
                          className={
                            typeof col === "object"
                              ? col.res
                                ? "ok"
                                : "fail"
                              : ""
                          }
                        >
                          {col.points ? col.points : col}
                        </td>
                      );
                    })}
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      );
    } else return <Fragment></Fragment>;
  }
}

export default GruppaReport;
