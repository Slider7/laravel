import React from "react";

import "./filter.css";

class Selector extends React.Component {
  constructor(props) {
    super(props);
    this.selRef = React.createRef();
  }

  fillOptions = list => {
    const sel = this.selRef.current;
    const option = document.createElement("option");
    option.value = "none";
    option.text = "Любое значение";
    sel.add(option);

    list.forEach(item => {
      const opt = document.createElement("option");
      opt.value = item;
      opt.text = item;
      sel.add(opt);
    });

    if (this.props.name === "period") {
      sel.options[1].value = 1;
      sel.options[2].value = 7;
      sel.options[3].value = 30;
      sel.options[4].value = 91;
      sel.options[5].value = 182;
      sel.options[6].value = 365;
    }
  };

  componentDidMount() {
    /* fetch API */
    fetch(`${this.props.selectorApi}`)
      .then(response => {
        return response.json();
      })
      .then(list => {
        this.fillOptions(list);
      });
  }

  render() {
    return (
      <div className="form-group filter-item mx-2 my-0">
        <label className="my-0" hmtlfor="selector">
          {this.props.caption}
        </label>
        <select
          className="form-control px-2 py-0"
          id={this.props.name}
          ref={this.selRef}
          onChange={this.props.filterChange}
        ></select>
      </div>
    );
  }
}

export default Selector;
