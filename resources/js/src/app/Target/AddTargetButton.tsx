import React from "react";
import { Plus } from "tabler-icons-react";
import style from "./Style.module.css";

function AddTargetButton(): JSX.Element {
  return (
    <button className={style.target_add__button}>
      <Plus width={36} height={36} />
      <span className={style.target_add__button_text}>Add Target</span>
    </button>
  );
}

export default AddTargetButton;
