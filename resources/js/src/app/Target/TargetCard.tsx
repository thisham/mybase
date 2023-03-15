import React from "react";
import style from "./Style.module.css";

type TargetCardProps = {
  title: string;
  target: number;
  current: number;
};

function TargetCard(props: TargetCardProps): JSX.Element {
  const progressPercentage = Math.ceil((props.current / props.target) * 100);

  return (
    <div className={style.target__card}>
      <img
        src="https://i.pinimg.com/564x/31/74/33/317433b415b8d2d193245c885fade433.jpg"
        alt="Target Image"
        className={style.target__picture}
      />
      <div className={style.target__text_container}>
        <div className={style.target__title_container}>
          <h3 className={style.target__title}>{props.title}</h3>
          <button className={style.target__tiny_button}>View Account</button>
        </div>

        <div className={style.target__progress_container}>
          <div className={style.target__progress_text_container}>
            <span className={style.target__progress_text}>
              {props.current} cress of {props.target} cress
            </span>
            <span className={style.target__progress_text}>
              {progressPercentage} %
            </span>
          </div>

          <div className={style.target__progress_bar}>
            <div
              className={style.target__progress_reached}
              style={{ width: `${progressPercentage}%` }}
            ></div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default TargetCard;
