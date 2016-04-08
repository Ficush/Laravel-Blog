@extends('layout.main')

@section('content')
@include('layout.alert')
<div class="entry-content">
    <p id="history">
        本站最初建于 2006 年 7 月，当时使用自己开发的 ASP 博客，博客框架参考当时较流行的论坛程序 <a href="http://www.bbsxp.com/">BBSXP</a>，
        搭建在 <a href="http://www.websamba.com/">Websamba</a> 免费空间上。在 2008 年 4 月进一步探索了网页开发技术，将博客更改为 ASP.Net 框架，前端改用 XHTML + CSS，
        随后于 2008 年 12 月迁移到 <a href="http://www.wordpress.com/">WordPress</a> 上，并在 <a href="http://www.godaddy.com/">Godaddy</a> 注册了
        自己的第一个<a href="http://www.ficush.com/">域名</a>，沿用至今。由于搭建在海外免费空间且因准备高考无暇管理，本博客曾长期闲置。
        于 2010 年考入<a href="http://www.sysu.edu.cn/">中山大学</a>就读本科后，曾重新开启过一段时间的博客，后因空间废用相关数据均已丢失。
        本科期间探索了 HTML5 与 CSS3、jQuery、Bootstrap 等新技术，了解了 ThinkPHP 等 MVC 框架。在 2015 年 5 月将博客迁移至<a href="http://sae.sina.com.cn/">新浪云空间</a>，沿用至今。
        在 2016 年 3 月基于 <a href="http://www.laravel.com/">Laravel</a> 框架开发了自己的第二个博客程序，并鉴于新浪云空间的 MySQL 日租金策略及空间的诸多限制，
        迁移至<a href="http://www.qcloud.com/">腾讯云主机</a>校园计划。以下为本站的文章归档：
    </p>
</div>
@if (!empty($data))
    @foreach($data as $key => $value)
        <div class="panel admin-panel" id="archive-{{ $key }}">
            <div class="panel-heading">
                {{ substr($key,0,4) . ' 年 ' . substr($key,4,2) . ' 月' }}
            </div>
            <div class="panel-body">
                <ul>
                @foreach($value as $entry)
                    <li><p>
                        <a href="{{ route('view.show', $entry -> id) }}">
                            {{ $entry -> title }}
                        </a>
                        （{{ $entry -> created_at -> format('Y-m-d') }}）
                    </p></li>
                @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif
@endsection
