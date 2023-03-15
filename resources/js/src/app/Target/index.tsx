import MainLayout from "@src/components/MainLayout";
import React from "react";
import AddTargetButton from "./AddTargetButton";
import style from "./Style.module.css";
import TargetCard from "./TargetCard";

function Target(): JSX.Element {
  return (
    <MainLayout pageTitle={"Target"} pageKey={"TARGET"}>
      <div className={style.main__container}>
        <div className={style.main__target_container}>
          <TargetCard
            title={"Kawasaki ZX-25RR"}
            target={145000}
            current={2000}
          />
          <AddTargetButton />
        </div>
      </div>
    </MainLayout>
  );
}

export default Target;
