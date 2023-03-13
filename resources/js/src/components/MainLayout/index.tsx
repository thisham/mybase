import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { ChevronLeft } from "tabler-icons-react";
import { PageKey } from "../../types/common";
import Sidenav from "../Sidenav";
import style from "./Style.module.css";

type MainLayoutProps = {
  children: JSX.Element;
  pageTitle: string;
  pageKey: PageKey;
  isBackButtonEnabled?: boolean;
};

function MainLayout(props: MainLayoutProps): JSX.Element {
  const navigate = useNavigate();

  useEffect(() => {
    document.title = `${props.pageTitle} - MyBase`;
  }, []);

  return (
    <div className={style.base}>
      <Sidenav activePage={props.pageKey} />

      <main className={style.main}>
        <div className={style.navigator}>
          {props.isBackButtonEnabled ? (
            <button className={style.back_button} onClick={() => navigate(-1)}>
              <ChevronLeft />
            </button>
          ) : null}
          <h1 className={style.page_title}>{props.pageTitle}</h1>
        </div>
        <div className={style.content}>{props.children}</div>
      </main>
    </div>
  );
}

export default MainLayout;
