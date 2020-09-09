import React, { Fragment } from 'react';

import './MainReport.css';

class MainReport extends React.Component {
  gruppaReportChange = evt => {
    this.props.selectRow(evt);

    let gruppaFilter = '';
    const selectedRow = evt.target.parentNode;
    for (let i = 1; i <= 4; i++) {
      gruppaFilter += `${selectedRow.cells[i].textContent}/`;
    }
    gruppaFilter += document.querySelector('#period').value;

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

  getDataWithAvg = data => {
    let res = [];
    let curr = data[0].teacher,
      avg = 0,
      k = 0;
    data.forEach(row => {
      if (row.teacher != curr) {
        res.push({
          teacher: 'Средний %',
          cnt: k,
          avg_prc: (avg / k).toFixed(3)
        });
        avg = 0;
        k = 0;
        curr = row.teacher;
      }
      avg += parseFloat(row.avg_prc * row.cnt);
      k += row.cnt;
      res.push(row);
    });
    res.push({ teacher: 'Средний %', cnt: k, avg_prc: (avg / k).toFixed(3) });
    return res;
  };

  render() {
    let period = '',
      currTeacher = '',
      reportData = [];
    const sel = document.querySelector('select #period');
    if (sel && sel.selectedIndex > 0)
      period = sel.options[sel.selectedIndex].text;
    if (this.props.reportData[0]) {
      reportData = this.getDataWithAvg(this.props.reportData);
    }
    return (
      <div className="container mx-auto">
        <div className="d-flex justify-content-center align-items-center">
          <h4 id="rep-header" className="text-center mt-3">
            Отчет по тестированиям: {period}
          </h4>
        </div>
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
            {reportData.map((row, i) => {
              return (
                <tr
                  key={`rep${i}`}
                  onClick={
                    row['teacher'] != 'Средний %'
                      ? this.gruppaReportChange
                      : null
                  }
                  className={
                    row['teacher'] == 'Средний %' ? 'avg-row' : 'selectable'
                  }
                >
                  <td>{i + 1}</td>
                  {row['teacher'] == 'Средний %' ? (
                    <>
                      <td colSpan="4">{row['teacher']}</td>
                      <td>{row['cnt']}</td>
                    </>
                  ) : (
                    <>
                      <td>{row['teacher']}</td>
                      <td>{row['program']}</td>
                      <td>{row['unit']}</td>
                      <td>{row['gruppa']}</td>
                      <td>{row['cnt']}</td>
                    </>
                  )}
                  <td>{row['avg_prc']}</td>
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
