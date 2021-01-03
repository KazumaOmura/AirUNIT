/*
 * snapshot.c
 *
 * ロボットの車載カメラのスナップショットをHTTPサーバ経由で取得する
 *
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <netdb.h>
#include <unistd.h>
#include <ctype.h>

#define basename(p)       ((strrchr((p),'/') ? : ((p)-1)) + 1)

#define BUF_SIZE          2048   /* バッファサイズ */
#define SERVER_PORT       8080   /* サーバの接続待ちポート番号 */

/* HTTPクライアント要求メッセージ */
#define HTTP_GET_MESSAGE  "GET %s HTTP/1.0\r\n\r\n"
#define HTTP_GET_FILE     "/?action=snapshot"

#define JPEG_FILE         "snap.jpg"
#define JPEG_SOI          0xD8
#define JPEG_EOI          0xD9
#define isLF(x)           (x == 0x0a)
#define isCR(x)           (x == 0x0d)

static char *progname = NULL;
static int  debug     = 1;

/*
 * main()
 */
int main(int argc, char *argv[])
{
  char   buf[BUF_SIZE], *fn;
  int    i, j, ret, sockfd, c, cb, pf, wf;
  struct sockaddr_in s_addr;
  struct hostent *he;
  FILE    *fp_http, *fp_jpeg;
  
  progname = basename(argv[0]);

  /* 引数チェック */
  if(argc != 2 && argc != 3 ) {
    printf("\nusage: %s host [file]\n\n", progname);
    return EXIT_SUCCESS;
  }  
  if(argc == 3) fn = argv[2];
  else          fn = JPEG_FILE;

  /* サーバアドレスとポートの設定 */  
  he = gethostbyname(argv[1]);
  if(he == NULL) {
    fprintf(stderr, "%s: gethostbyname(): Unknown host\n", progname);
    return EXIT_FAILURE;
  }
  s_addr.sin_family = AF_INET;
  memcpy((char *)&s_addr.sin_addr, (char *)he->h_addr, he->h_length);
  s_addr.sin_port = htons(SERVER_PORT);

  /***** テキストのリスト4.4 を参照 *****/
  /* ソケットの作成 */
    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if(sockfd < 0){
        perror("socket()");
        return EXIT_FAILURE;
    }
  /* HTTPサーバと接続 */
    if (connect(sockfd, (struct sockaddr *)&s_addr, sizeof (s_addr)) < 0) {
        perror("connect()"); 
        return EXIT_FAILURE;
    }
    if (debug) { 
        printf("%s: Connected to %s (port: %d)\n",
        progname, argv[1], SERVER_PORT);
    }

  /* HTTPサーバに送信するメッセージの作成と送信 */
    sprintf(buf, HTTP_GET_MESSAGE, HTTP_GET_FILE);
    if(debug){
        printf("%s: Sent a message: \n%s", progname, buf);
    }
    ret = write(sockfd, buf, strlen(buf));
    if (ret < 0) {
        perror("write()"); 
        close (sockfd); 
        return EXIT_FAILURE;
    }
  /* 保存JPEGファイルのオープン */
    if ((fp_jpeg = fopen(fn, "w")) == NULL) {
        fprintf(stderr, "%s: Could not open %s.\n", progname, fn); 
        close (sockfd); 
        return EXIT_FAILURE;
    }

  /* サーバからのメッセージを標準入出力関数(stdio.h)で受信する */  
    if ((fp_http = fdopen(sockfd, "r")) == NULL) {
        perror("fdopen()"); 
        close (sockfd); 
        return EXIT_FAILURE;
    }
    i = 0; 
    j = 0; 
    cb = OxFF;
    pf = 1; 
    wf = 0; 
    while(1) {
        c = fgetc(fp_http);

        /*受信メッセージの受信*/
        if (pf == 1 && (isprint(c) || isLF(c))) {
            if(debug) printf("%c", c);
        }
        else if (pf == 1 && isCR(c)) ; 
        else {
            if (debug) printf("%02X", c); 
            j++; 
            if(j == 30) {
                if (debug) printf("\n"); 
                j = 0;
            }
            if (pf == 1) pf = 0;
        }

        /* JPEG FILE の書き込み */ 
        if (cb == OxFF && c == JPEG_SOI) {
            fputc(c, fp_jpeg); 
            i++; 
            wf = 1;
        }
        if (cb == OxFF && c == JPEG_EOI) {
            fputc(c, fp_jpeg); 
            i++; 
            fclose(fp_jpeg); 
            break;
        }
        if(wf) {
            fputc(c, fp_jpeg); 
            i++;
        }
        cb = c;
    }
    if (debug)
        printf("\n\n%s: Received %d Byte JPEG FILE\n", progname, i);

  /* 通信用のソケットを破棄 */
    close (sockfd); /* fclose(fp_http) */
 
  /* 正常終了 */
  return EXIT_SUCCESS;
}

