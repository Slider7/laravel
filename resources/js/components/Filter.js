import React from "react";

import Selector from "./Selector";
import "./filter.css";

function Filter(props) {
  const { filter } = props;
  const captions = ["Преподаватели", "Программы", "Юниты", "Группы", "Период"];
  return (
    <div className="d-flex flex-wrap col-md-8 mx-auto border border-secondary rounded py-3">
      {Object.entries(filter).map((item, i) => {
        return (
          <Selector
            key={i}
            name={item[0]}
            selectorApi={`/${item[0]}-col`}
            caption={captions[i]}
            value={item[1]}
            filterChange={props.filterChange}
          />
        );
      })}
      <div className="form-group filter-item mx-2 my-0 d-flex align-items-center">
        <input
          type="checkbox"
          id="mode-select"
          className="mt-2"
          checked={!props.mode}
          onChange={props.modeChange}
        />
        <label hmtlfor="mode-select" className="mt-2 mb-0 ml-2">
          Дополнительный отчет
        </label>
      </div>
    </div>
  );
}

export default Filter;
